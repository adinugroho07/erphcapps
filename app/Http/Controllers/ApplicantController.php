<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Assignment;
use App\Models\Organization;
use App\Models\Recruitmenthistory;
use App\Models\Wfassignment;
use App\Traits\WorkflowTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ApplicantController extends Controller
{

    use WorkflowTraits;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applicant = Applicant::paginate(7);
        return Inertia::render('Recruitment/ListRecruitment',[
            'applicantlist' => $applicant
        ]);
    }

    public function search()
    {
        $applicant = Applicant::latest()->search(request(['search']))->paginate(7)->withQueyrString();
        return Inertia::render('Recruitment/ListRecruitment', [
            'applicantlist' => $applicant,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $codeapplicant = Applicant::max('id');
        $setCodeApplicant = '';
        if($codeapplicant){
            //if not null then
            $setCodeApplicant = 'APLCNT'.$codeapplicant+1;
        } else {
            //if null then
            $setCodeApplicant = 'APLCNT1';
        }
        $assignment = Assignment::all();
        $department = Organization::distinct()->get(['org_code','org_name']);
        $position = Organization::all('position_title','position_code','org_code','org_name');
        return Inertia::render('Recruitment/CreateRecruitment', [
            'codeapplicant' => $setCodeApplicant,
            'assignment' => $assignment,
            'department' => $department,
            'position' => $position,
        ]);
    }

    public function showApprovalPage($id){

        $applicant = Applicant::find($id);

        $applicant->ijazah = $applicant->ijazah == '' ? '':asset( 'storage/'.$applicant->ijazah);
        $applicant->cv = $applicant->cv == '' ? '':asset( 'storage/'.$applicant->cv);

        $assignment = Assignment::all();
        $assignmentdetail = Wfassignment::where('assignstatus', 'ACTIVE')->where('ownertrxid',$id)->first();
        $recruitmenthistory = Recruitmenthistory::where('ownertrxid',$id)->get();
        $department = Organization::distinct()->get(['org_code','org_name']);
        $position = Organization::all('position_title','position_code','org_code','org_name');
        return Inertia::render('Recruitment/ApprovalRecruitment',[
            'applicant' => $applicant,
            'assignment' => $assignment,
            'assignmentnow' => $assignmentdetail,
            'recruitmenthistory' => $recruitmenthistory,
            'department' => $department,
            'position' => $position,
        ]);

    }

    public function storeApproval(Request $request){
        $request->validate([
            'applicantcode' => ['required'],
            'status' => ['required'],
            'id' => ['required'],
            'assignment_id' => ['required'],
            'assignment_code' => ['required'],
            'memo' => ['required','max:400'],
            'action' => ['required']
        ]);

        $notifMessage = 'test';

        if ($request->action == 'APPROVE'){
            //proses approve
            $assignmentdetail = $this->approve(
                $request->assignment_code,
                $request->assignment_id,
                $request->status,
                $request->id,
                'APPLICANT',
                $request->applicantcode,
                'assignment/'.$request->id.'/applicant/approval'
            );

            //update status doc applicant
            $applicantupdt = Applicant::find($request->id);
            $applicantupdt->status = $assignmentdetail->status;
            $applicantupdt->isedit = false;
            $applicantupdt->save();

            $username = Auth::user()->name;

            //insert to history status
            Recruitmenthistory::create([
                'ownertrxid' => $request->id,
                'status' => $request->status,
                'changeby' => $username,
                'memo' => $request->memo,
            ]);

            if ($assignmentdetail->status == 'APPR') {
                Recruitmenthistory::create([
                    'ownertrxid' => $request->id,
                    'status' => $assignmentdetail->status,
                    'changeby' => $username,
                    'memo' => 'Document Approved',
                ]);
            }

            $notifMessage = 'Approve Successfully';
        };

        if ($request->action == 'REJECT'){
            $assignmentdetail = $this->reject(
                $request->assignment_code,
                $request->id,
                $request->status
            );

            //update status doc applicant
            $applicantupdt = Applicant::find($request->id);
            $applicantupdt->status = 'REJECTED';
            $applicantupdt->isedit = false;
            $applicantupdt->save();

            $username = Auth::user()->name;

            //insert to history status
            Recruitmenthistory::create([
                'ownertrxid' => $request->id,
                'status' => 'REJECTED',
                'changeby' => $username,
                'memo' => $request->memo,
            ]);

            $notifMessage = 'Document Rejected Successfully';
        };

        $applicant = Applicant::find($request->id);
        $assignment = Assignment::all();
        $assignmentnow = Wfassignment::where('assignstatus', 'ACTIVE')->where('ownertrxid',$request->id)->first();
        $recruitmenthistory = Recruitmenthistory::where('ownertrxid',$request->id)->get();
        Inertia::share('flash', session('flash', ['message' => $notifMessage]));
        return Inertia::render('Recruitment/ApprovalRecruitment',[
            'applicant' => $applicant,
            'assignment' => $assignment,
            'assignmentnow' => $assignmentnow,
            'recruitmenthistory' => $recruitmenthistory,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'status' => ['required','max:100'],
            'applicantcode' => ['required'],
            'assignment_id' => ['required'],
            'assignment_code' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required','string', 'email', 'max:255'],
            'gender' => ['required'],
            'birthdate' => ['required','date'],
            'placeborn' => ['required'],
            'address' => ['required', 'max:400'],
            'religion' => ['required'],
            'married' => ['required'],
            'NIK' => ['required'],
            'NPWP' => ['required'],
            'bloodtype' => ['required'],
            'districts' => ['required'],
            'city' => ['required'],
            'postalcode' => ['required'],
            'citizenship' => ['required'],
            'phonenumber' => ['required'],
            'degree' => ['required'],
            'lastdegree' => ['required'],
            'major' => ['required'],
            'studyprogram' => ['required'],
            'startschool' => ['required','date'],
            'endschool' => ['required','date'],
            'ijazah' => ['required', 'mimes:pdf,doc,docx', 'max:5120'],
            'cv' => ['required', 'mimes:pdf,doc,docx', 'max:5120'],
        ]);

        $objectapplicant = '';
        if ($request->action == 'HOLD'){
            // wf tidak berjalan.

            //create applicant
            $objectapplicant = $this->createApplicant($request);

            $username = Auth::user()->name;

            //insert to history status
            Recruitmenthistory::create([
                'ownertrxid' => $objectapplicant->id,
                'status' => $objectapplicant->status,
                'changeby' => $username,
                'memo' => 'Doc On Hold',
            ]);
        }

        if ($request->action == 'ROUTE'){
            $isexist = Applicant::where('applicantcode',$request->applicantcode)->first();

            if ($isexist == null){
                // kalo get data nyaa not found maka dia akan create
                //create applicant
                $objectapplicant = $this->createApplicant($request);
            } else {
                $objectapplicant = $isexist;
            }

            // urutannya approve/init dulu -> change doc status ke status selanjutnya -> insert doc transaksi history.
            $assignmentdetail = $this->init(
                $request->assignment_code,
                $request->assignment_id,
                $objectapplicant->id,
                'APPLICANT',
                $objectapplicant->applicantcode,
                'assignment/'.$objectapplicant->id.'/applicant/approval'
            );

            //update status doc applicant
            $applicantupdt = Applicant::find($objectapplicant->id);
            $applicantupdt->status = $assignmentdetail->status;
            $applicantupdt->isedit = true;
            $applicantupdt->save();

            $username = Auth::user()->name;

            //insert to history status
            Recruitmenthistory::create([
                'ownertrxid' => $objectapplicant->id,
                'status' => $objectapplicant->status,
                'changeby' => $username,
                'memo' => 'initial DRAFT Status',
            ]);
        }

        return redirect()->back()->with('message', 'Applicant Successfully Create');
    }

    public function createApplicant(Request $request){
        $applicant = Applicant::create([
            'status' => $request->status,
            'applicantcode' => $request->applicantcode,
            'assignment_id' => $request->assignment_id,
            'assignment_code' => $request->assignment_code,
            'department' => $request->department,
            'department_code' => $request->department_code,
            'posname' => $request->posname,
            'poscode' => $request->poscode,
            'isedit' => $request->isedit,
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'birthdate' => $request->birthdate,
            'placeborn' => $request->placeborn,
            'address' => $request->address,
            'religion' => $request->religion,
            'married' => $request->married,
            'NIK' => $request->NIK,
            'NPWP' => $request->NPWP,
            'bloodtype' => $request->bloodtype,
            'districts' => $request->districts,
            'city' => $request->city,
            'postalcode' => $request->postalcode,
            'citizenship' => $request->citizenship,
            'phonenumber' => $request->phonenumber,
            'degree' => $request->degree,
            'lastdegree' => $request->lastdegree,
            'major' => $request->major,
            'studyprogram' => $request->studyprogram,
            'startschool' => $request->startschool,
            'endschool' => $request->endschool,
            'positionexporg' => $request->positionexporg,
            'orgname' => $request->orgname,
            'orgdescriptions' => $request->orgdescriptions,
            'inorg' => $request->inorg,
            'outorg' => $request->outorg,
            'ijazah' => $request->file('ijazah')->storeAs('Applicant','ijazah_'.$request->applicantcode.'.'.$request->file('ijazah')->extension()),
            'cv' => $request->file('cv')->storeAs('Applicant','cv_'.$request->applicantcode.'.'.$request->file('ijazah')->extension()),
        ]);

        return $applicant;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function show(Applicant $applicant)
    {

        $applicant->ijazah = $applicant->ijazah == '' ? '':asset( 'storage/'.$applicant->ijazah);
        $applicant->cv = $applicant->cv == '' ? '':asset( 'storage/'.$applicant->cv);

        $assignment = Assignment::all();
        $assignmentnow = Wfassignment::where('assignstatus', 'ACTIVE')->where('ownertrxid',$applicant->id)->first();
        $recruitmenthistory = Recruitmenthistory::where('ownertrxid',$applicant->id)->get();
        $department = Organization::distinct()->get(['org_code','org_name']);
        $position = Organization::all('position_title','position_code','org_code','org_name');
        return Inertia::render('Recruitment/ShowRecruitment',[
            'applicant' => $applicant,
            'assignment' => $assignment,
            'assignmentnow' => $assignmentnow,
            'recruitmenthistory' => $recruitmenthistory,
            'department' => $department,
            'position' => $position,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function edit(Applicant $applicant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Applicant $applicant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Applicant $applicant)
    {
        //
    }
}
