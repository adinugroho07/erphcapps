<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Assignment;
use App\Models\Organization;
use App\Models\Recruitmenthistory;
use App\Models\User;
use App\Models\Wfassignment;
use App\Traits\WorkflowTraits;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class ApplicantController extends Controller
{

    use WorkflowTraits;

    public function __construct()
    {
        $this->authorizeResource(Applicant::class, 'applicant');
    }

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
        $applicant = Applicant::latest()->search(request(['search']))->paginate(7);
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
        $assignment = Assignment::where('isactive',1)->get();
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

        $this->authorize('approveShow', Applicant::class);

        $applicant = Applicant::find($id);

        $applicant->ijazah = $applicant->ijazah == '' ? '':asset( 'storage/'.$applicant->ijazah);
        $applicant->cv = $applicant->cv == '' ? '':asset( 'storage/'.$applicant->cv);

        $assignment = Assignment::where('isactive',1)->get();;
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

        $this->authorize('approveStore', Applicant::class);

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
        $statusToBeBack = '';

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
            if($assignmentdetail->status == 'COMPLETE'){
                $applicantupdt->status = 'APPR';
            }else{
                $applicantupdt->status = $assignmentdetail->status;
            }
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

            if ($assignmentdetail->status == 'COMPLETE') {
                Recruitmenthistory::create([
                    'ownertrxid' => $request->id,
                    'status' => 'APPR',
                    'changeby' => $username,
                    'memo' => 'Document Approved',
                ]);
            }
            $statusToBeBack = $assignmentdetail->status;
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

            $statusToBeBack = 'REJECTED';
            $notifMessage = 'Document Rejected Successfully';
        };

        $assignmentnow = Wfassignment::where('assignstatus', 'ACTIVE')->where('ownertrxid',$request->id)->first();

        return redirect()->back()->with('message',[
            'status' => $statusToBeBack,
            'message' => $notifMessage,
            'assignment' => $assignmentnow->assignperson
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
            'applicantcode' => ['required','unique:applicant'],
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
        $notifMessage = 'test';
        $statusToBeBack = '';
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
            $statusToBeBack = 'HOLD';
            $notifMessage = 'Document Hold Successfully';
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

            $statusToBeBack = $assignmentdetail->status;
            $notifMessage = 'Applicant Successfully Create And Route';
        }

        return redirect()->back()->with('message', ['status' => $statusToBeBack, 'message' => $notifMessage]);
    }

    public function showlistcreate(){

        $this->authorize('showListApplicantAppr', Applicant::class);

        $applicant = Applicant::where('status','APPR')->paginate(7);
        //$applicant = Applicant::paginate(7);
        return Inertia::render('Recruitment/ListRecruitmentCreateAccount',[
            'applicantlist' => $applicant,
        ]);
    }

    public function createUser(){

        $this->authorize('showApplicantAppr', Applicant::class);

        $applicant = Applicant::find(request()->id);
        $user = User::where('status','active')->where('email',$applicant->email)->first();

        if($user != null){
            throw ValidationException::withMessages(['message' => 'User Already Exists !!']);
        }

        $userManager = User::where('status','active')->whereIn('position_category', array('VP','MGR','GM'))->get();
        $department = Organization::distinct()->get(['org_code','org_name']);
        $position = Organization::all('position_title','position_code','org_code','org_name');
        $users = User::where('status','active')->get(['id','name','backtoback','backtoback_id','posname']);

        return Inertia::render('Recruitment/CreateUserFromApplicant',[
            'applicant' => $applicant,
            'userManager' => $userManager,
            'department' => $department,
            'position' => $position,
            'users' => $users
        ]);
    }

    public function storeUser(Request $request){

        $this->authorize('createUserFromApplicantAppr', Applicant::class);

        $request->validate([
            'name' => ['required','string', 'max:255'],
            'email' => ['required','string', 'email', 'max:255', 'unique:users'],
            'nik' => ['required','string', 'max:255'],
            'suppervisor' => ['required'],
            'suppervisor_posname' => ['required'],
            'suppervisor_id' => ['required'],
            'position_category' => ['required'],
            'department' => ['required'],
            'department_code' => ['required'],
            'posname' => ['required'],
            'poscode' => ['required'],
            'status' => ['required'],
            'expiredcontractdate' => ['required'],
            'posstatus' => ['required'],
            'sex' => ['required'],
            'birthdate' => ['required'],
            'religion' => ['required'],
            'married' => ['required'],
            'bankkey' => ['required'],
            'bank' => ['required'],
            'address' => [ 'max:500'],
        ],[
            'bankkey.required' => 'Bank Number Field Is Required',
            'bank.required' => 'Bank Field Is Required',
            'posstatus.required' => 'Status Employee Field Is Required',
        ]);

        $data = [
            'name' => $request->name ,
            'email' => $request->email ,
            'nik' => $request->nik ,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' ,
            'suppervisor' => $request->suppervisor ,
            'suppervisor_posname' => $request->suppervisor_posname ,
            'suppervisor_id' => $request->suppervisor_id ,
            'position_category' => '' ,
            'department' => $request->department ,
            'department_code' => $request->department_code ,
            'posname' => $request->posname ,
            'poscode' => $request->poscode ,
            'status' => 'active' ,
            'expiredcontractdate' => null ,
            'posstatus' => 'pekerja' ,
            'sex' => $request->sex ,
            'birthdate' => Carbon::parse($request->birthdate)->format('Y-m-d H:i:s') ,
            'religion' => $request->religion ,
            'spouse' => $request->spouse ,
            'child1' => $request->child1 ,
            'child2' => $request->child2 ,
            'child3' => $request->child3 ,
            'married' => $request->married ,
            'state' => $request->state ,
            'city' => $request->city ,
            'phonenum' => $request->phonenum ,
            'bankkey' => $request->bankkey ,
            'address' => $request->address ,
            'backtoback' => $request->backtoback ,
            'backtoback_id' => $request->backtoback_id ,
            'postalcode' => $request->postalcode ,
            'bank' => $request->bank
        ];

        //dd($data);
        //insert data users
        User::create($data);

        //update status applicant to complete
        $applicant = Applicant::find($request->applicantid);
        $applicant->status = 'COMPLETE';
        $applicant->isedit = true;
        $applicant->save();

        $username = Auth::user()->name;

        //add history applicant to complete
        Recruitmenthistory::create([
            'ownertrxid' => $request->applicantid,
            'status' => 'COMPLETE',
            'changeby' => $username,
            'memo' => 'Document Complete. User Has Been Created',
        ]);

        return redirect()->route('applicant.listcreateuser')->with('message', 'User Successfully Create Form Recruitment Data');
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
            'cv' => $request->file('cv')->storeAs('Applicant','cv_'.$request->applicantcode.'.'.$request->file('cv')->extension()),
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

        $assignment = Assignment::where('isactive',1)->get();;
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

        $applicant->ijazahh = $applicant->ijazahh == '' ? '':asset( 'storage/'.$applicant->ijazahh);
        $applicant->cv = $applicant->cv == '' ? '':asset( 'storage/'.$applicant->cv);
        $assignment = Assignment::where('isactive',1)->get();;
        $department = Organization::distinct()->get(['org_code','org_name']);
        $position = Organization::all('position_title','position_code','org_code','org_name');
        $recruitmenthistory = Recruitmenthistory::where('ownertrxid',$applicant->id)->get();
        return Inertia::render('Recruitment/EditRecruitment', [
            'applicant' => $applicant,
            'assignment' => $assignment,
            'department' => $department,
            'position' => $position,
            'recruitmenthistory' => $recruitmenthistory,
        ]);
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
        ]);

        if ($request->file('ijazah')){
            //kalo ada file yang di input
            if (
                $request->file('ijazah')->extension() == 'pdf' ||
                $request->file('ijazah')->extension() == 'doc' ||
                $request->file('ijazah')->extension() == 'docx'
            ){
            } else {
                throw ValidationException::withMessages(['ijazah' => 'Extension File From Attachment 1 Not Valid']);
            }
            // satuan dalam byte
            if ($request->file('attachment1')->getSize() > 5120000){
                throw ValidationException::withMessages(['ijazah' => 'File Size From Attachment 1 Too Big, Please Upload File Below 5mb']);
            }
        }

        if ($request->file('cv')){
            //kalo ada file yang di input
            if (
                $request->file('cv')->extension() == 'pdf' ||
                $request->file('cv')->extension() == 'doc' ||
                $request->file('cv')->extension() == 'docx'
            ){
                $isoke = true;
            } else {
                $isoke = false;
                throw ValidationException::withMessages(['cv' => 'Extension File From Attachment 2 Not Valid']);
            }

            if ($request->file('cv')->getSize() > 5120000){
                throw ValidationException::withMessages(['cv' => 'File Size From Attachment 2 Too Big, Please Upload File Below 5mb']);
            }
        }

        //update data
        $this->updateApplicantData($request,$applicant);
        $notifMessage = 'test';
        $statusToBeBack = '';

        // urutannya approve/init dulu -> change doc status ke status selanjutnya -> insert doc transaksi history.
        $assignmentdetail = $this->init(
            $request->assignment_code,
            $request->assignment_id,
            $request->id,
            'APPLICANT',
            $request->applicantcode,
            'assignment/'.$request->id.'/applicant/approval'
        );

        //update status doc timesheet ke status selanjut nya.
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
            'memo' => 'initial DRAFT Status',
        ]);

        $statusToBeBack = $assignmentdetail->status;
        $notifMessage = 'Timesheet Successfully Edit And Route';

        $assignmentnow = Wfassignment::where('assignstatus', 'ACTIVE')->where('ownertrxid',$request->id)->first();

        return redirect()->back()->with('message',[
            'status' => $statusToBeBack,
            'message' => $notifMessage,
            'assignment' => $assignmentnow->assignperson
        ]);
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

    public function updateApplicantData($request,$applicant){

        $applicant->status = $request->status;
        $applicant->applicantcode = $request->applicantcode;
        $applicant->assignment_id = $request->assignment_id;
        $applicant->assignment_code = $request->assignment_code;
        $applicant->department = $request->department;
        $applicant->department_code = $request->department_code;
        $applicant->posname = $request->posname;
        $applicant->poscode = $request->poscode;
        $applicant->isedit = $request->isedit;
        $applicant->name = $request->name;
        $applicant->email = $request->email;
        $applicant->gender = $request->gender;
        $applicant->birthdate = $request->birthdate;
        $applicant->placeborn = $request->placeborn;
        $applicant->address = $request->address;
        $applicant->religion = $request->religion;
        $applicant->married = $request->married;
        $applicant->NIK = $request->NIK;
        $applicant->NPWP = $request->NPWP;
        $applicant->bloodtype = $request->bloodtype;
        $applicant->districts = $request->districts;
        $applicant->city = $request->city;
        $applicant->postalcode = $request->postalcode;
        $applicant->citizenship = $request->citizenship;
        $applicant->phonenumber = $request->phonenumber;
        $applicant->degree = $request->degree;
        $applicant->lastdegree = $request->lastdegree;
        $applicant->major = $request->major;
        $applicant->studyprogram = $request->studyprogram;
        $applicant->startschool = $request->startschool;
        $applicant->endschool = $request->endschool;
        $applicant->positionexporg = $request->positionexporg;
        $applicant->orgname = $request->orgname;
        $applicant->orgdescriptions = $request->orgdescriptions;
        $applicant->inorg = $request->inorg;
        $applicant->outorg = $request->outorg;

        //nama file yang di upload akan di override karena jika nama file nya panjang dan tidak baku maka akan menjadi malware.
        if($request->file('ijazah') != null){
            //jika file tidak null maka file yang sudah di upload sebelum nya akan di replace. di hapus dulu baru di insert.
            Storage::delete(asset( 'storage/'.$applicant->ijazah));
            $applicant->ijazah = $request->file('ijazah')->storeAs('Applicant','ijazah_'.$request->applicantcode.'.'.$request->file('ijazah')->extension());
        }

        //nama file yang di upload akan di override karena jika nama file nya panjang dan tidak baku maka akan menjadi malware.
        if($request->file('cv') != null){
            //jika file tidak null maka file yang sudah di upload sebelum nya akan di replace. di hapus dulu baru di insert.
            Storage::delete(asset( 'storage/'.$applicant->cv));
            $applicant->ijazah = $request->file('cv')->storeAs('Applicant','cv_'.$request->applicantcode.'.'.$request->file('cv')->extension());
        }

        $applicant->save();

    }
}
