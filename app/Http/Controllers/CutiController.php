<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Cuti;
use App\Models\Cutihistory;
use App\Models\Jatahcuti;
use App\Models\Wfassignment;
use App\Traits\WorkflowTraits;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class CutiController extends Controller
{

    use WorkflowTraits;

    public function __construct()
    {
        $this->authorizeResource(Cuti::class, 'cuti');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        $cuti = Cuti::where('created_byid',$id)->paginate(7);
        return Inertia::render('Cuti/CutiIndex',[
            'cuti' => $cuti
        ]);
    }

    public function search()
    {
        $cuti = Cuti::latest()->where('created_byid',Auth::id())->search(request(['search']))->paginate(7);
        return Inertia::render('Cuti/CutiIndex', [
            'cuti' => $cuti,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cutiid = Cuti::max('id');
        $setCodeCuti = '';
        if($cutiid){
            //if not null then
            $setCodeCuti = 'LVE'.$cutiid+1;
        } else {
            //if null then
            $setCodeCuti = 'LVE1';
        }
        $assignment = Assignment::where('isactive',1)->get();
        $jatahcuti = Jatahcuti::where('user_id',Auth::id())->first();
        return Inertia::render('Cuti/CutiCreate',[
            'codecuti' => $setCodeCuti,
            'assignment' => $assignment,
            'jatahcuti' => $jatahcuti
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
            'assignment_code' => ['required'],
            'assignment_id' => ['required'],
            'status' => ['required'],
            'cuticode' => ['required','unique:cuti'],
            'isedit' => ['required'],
            'department' => ['required'],
            'department_code' => ['required'],
            'posname' => ['required'],
            'poscode' => ['required'],
            'name' => ['required'],
            'email' => ['required'],
            'description' => ['required'],
            'nik' => ['required'],
            'typecuti' => ['required'],
            'startdate' => ['required'],
            'enddate' => ['required'],
            'created_by' => ['required'],
            'created_byid' => ['required'],
        ]);

        if ($request->file('attachment1')){
            //kalo ada file yang di input
            if (
                $request->file('attachment1')->extension() == 'pdf' ||
                $request->file('attachment1')->extension() == 'doc' ||
                $request->file('attachment1')->extension() == 'docx'
            ){
                $isoke = true;
            } else {
                $isoke = false;
                throw ValidationException::withMessages(['attachment1' => 'Extension File From Attachment 1 Not Valid']);
            }
            // satuan dalam byte
            if ($request->file('attachment1')->getSize() > 5120000){
                throw ValidationException::withMessages(['attachment1' => 'File Size From Attachment 1 Too Big, Please Upload File Below 5mb']);
            }
        }

        if ($request->file('attachment2')){
            //kalo ada file yang di input
            if (
                $request->file('attachment2')->extension() == 'pdf' ||
                $request->file('attachment2')->extension() == 'doc' ||
                $request->file('attachment2')->extension() == 'docx'
            ){
                $isoke = true;
            } else {
                $isoke = false;
                throw ValidationException::withMessages(['attachment2' => 'Extension File From Attachment 2 Not Valid']);
            }


            if ($request->file('attachment2')->getSize() > 5120000){
                throw ValidationException::withMessages(['attachment2' => 'File Size From Attachment 2 Too Big, Please Upload File Below 5mb']);
            }
        }

        $data = [
            'assignment_code' => $request->assignment_code ,
            'assignment_id' => $request->assignment_id ,
            'status' => $request->status ,
            'cuticode' => $request->cuticode ,
            'isedit' => $request->isedit ,
            'department' => $request->department ,
            'department_code' => $request->department_code ,
            'posname' => $request->posname ,
            'poscode' => $request->poscode ,
            'name' => $request->name ,
            'email' => $request->email ,
            'description' => $request->description ,
            'nik' => $request->nik ,
            'typecuti' => $request->typecuti ,
            'startdate' => Carbon::parse($request->startdate)->format('Y-m-d')  ,
            'enddate' => Carbon::parse($request->enddate)->format('Y-m-d') ,
            'created_by' => $request->created_by ,
            'created_byid' => $request->created_byid ,
            'attachment1' => '' ,
            'attachment2' => '' ,
        ];

        if($request->file('attachment1') != null){
            $data['attachment1'] = $request->file('attachment1')->storeAs('Cuti/'.$request->cuticode,'CUTI_'.$request->cuticode.'.'.$request->file('attachment1')->extension());
        }

        if($request->file('attachment2') != null){
            $data['attachment2'] = $request->file('attachment2')->storeAs('Cuti/'.$request->cuticode,'CUTI_'.$request->cuticode.'.'.$request->file('attachment2')->extension());
        }

        $lamacuti = Carbon::parse($request->startdate)->diffInDays(Carbon::parse($request->enddate));
        $jatahcuti = Jatahcuti::where('user_id',$request->created_byid)->first();
        if ($request->typecuti == 'CUTITAHUNAN'){
            if($lamacuti > $jatahcuti->cutitahunan){
                throw ValidationException::withMessages(['cuti' => 'Leave Allowance Has Exceeded The Limit']);
            }
        } else {
            if($lamacuti > $jatahcuti->cutimelahirkan){
                throw ValidationException::withMessages(['cuti' => 'Leave Allowance Has Exceeded The Limit']);
            }
        }

        $cutiObjt = Cuti::create($data);

        $assignmentdetail = $this->init(
            $request->assignment_code,
            $request->assignment_id,
            $cutiObjt->id,
            'CUTI',
            $cutiObjt->cuticode,
            'assignment/'.$cutiObjt->id.'/cuti/approval'
        );

        //update status doc timesheet ke status selanjut nya.
        $timsheetupdt = Cuti::find($cutiObjt->id);
        $timsheetupdt->status = $assignmentdetail->status;
        $timsheetupdt->isedit = true;
        $timsheetupdt->save();

        $username = Auth::user()->name;

        //insert to history status
        Cutihistory::create([
            'ownertrxid' => $cutiObjt->id,
            'status' => $cutiObjt->status,
            'changeby' => $username,
            'memo' => 'initial DRAFT Status',
        ]);

        return redirect()->back()->with('message',['status' => $assignmentdetail->status, 'message' => 'Successfully Create Leave Form And Route']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function show(Cuti $cuti)
    {
        $cuti->attachment1 = $cuti->attachment1 == '' ? '':asset( 'storage/'.$cuti->attachment1);
        $cuti->attachment2 = $cuti->attachment2 == '' ? '':asset( 'storage/'.$cuti->attachment2);
        $assignment = Assignment::where('isactive',1)->get();
        $wfassignment = Wfassignment::where('assignstatus', 'ACTIVE')->where('ownertrxid',$cuti->id)->first();
        $cutihistory = Cutihistory::where('ownertrxid',$cuti->id)->get();
        return Inertia::render('Cuti/CutiShow',[
            'cuti' => $cuti,
            'cutihistory' => $cutihistory,
            'assignment' => $assignment,
            'assignmentnow' => $wfassignment,
        ]);
    }

    public function showApprovalPage($id){

        $this->authorize('approveShow', Cuti::class);

        $cuti = Cuti::find($id);

        $cuti->attachment1 = $cuti->attachment1 == '' ? '':asset( 'storage/'.$cuti->attachment1);
        $cuti->attachment2 = $cuti->attachment2 == '' ? '':asset( 'storage/'.$cuti->attachment2);
        $assignmentnow = Wfassignment::where('assignstatus', 'ACTIVE')->where('ownertrxid',$cuti->id)->first();
        $assignment = Assignment::where('isactive',1)->get();
        $doahistory = Cutihistory::where('ownertrxid',$cuti->id)->get();
        return Inertia::render('Cuti/CutiApproval',[
            'cuti' => $cuti,
            'assignment' => $assignment,
            'assignmentnow' => $assignmentnow,
            'cutihistory' => $doahistory,
        ]);
    }

    public function storeApproval(Request $request){

        $this->authorize('approveStore', Cuti::class);

        $request->validate([
            'cuticode' => ['required'],
            'status' => ['required'],
            'id' => ['required'],
            'assignment_id' => ['required'],
            'assignment_code' => ['required'],
            'memo' => ['required','max:400'],
            'action' => ['required']
        ]);

        $notifMessage = 'test';
        $statusToBeBack = '';

        if ($request->action == 'REJECT'){
            $assignmentdetail = $this->reject(
                $request->assignment_code,
                $request->id,
                $request->status
            );

            //update status doc applicant
            $cutiupdt = Cuti::find($request->id);
            $cutiupdt->status = 'REJECTED';
            $cutiupdt->isedit = false;
            $cutiupdt->save();

            $username = Auth::user()->name;

            //insert to history status
            Cutihistory::create([
                'ownertrxid' => $request->id,
                'status' => 'REJECTED',
                'changeby' => $username,
                'memo' => $request->memo,
            ]);
            $statusToBeBack = 'REJECTED';
            $notifMessage = 'Document Rejected Successfully';
        };

        if ($request->action == 'APPROVE'){
            //proses approve
            $assignmentdetail = $this->approve(
                $request->assignment_code,
                $request->assignment_id,
                $request->status,
                $request->id,
                'CUTI',
                $request->cuticode,
                'assignment/'.$request->id.'/cuti/approval'
            );

            //update status doc timesheet
            $cutiupdt = Cuti::find($request->id);
            $cutiupdt->status = $assignmentdetail->status;
            $cutiupdt->isedit = false;
            $cutiupdt->save();

            $username = Auth::user()->name;

            //insert to history status
            Cutihistory::create([
                'ownertrxid' => $request->id,
                'status' => $request->status,
                'changeby' => $username,
                'memo' => $request->memo,
            ]);

            if ($assignmentdetail->status == 'COMPLETE') {
                //pengurangan jatah cuti
                $cutiObjt = Cuti::find($request->id);
                $jatahcuti = Jatahcuti::where('user_id',$request->id)->first();
                $lamacuti = Carbon::parse($cutiObjt->startdate)->diffInDays(Carbon::parse($cutiObjt->enddate));

                if ($cutiObjt->typecuti == 'CUTITAHUNAN'){
                    $jatahcuti->cutitahunan = $jatahcuti->cutitahunan - $lamacuti;
                } else {
                    $jatahcuti->cutimelahirkan = $jatahcuti->cutimelahirkan - $lamacuti;
                }

                $jatahcuti->save();

                Cutihistory::create([
                    'ownertrxid' => $request->id,
                    'status' => $assignmentdetail->status,
                    'changeby' => $username,
                    'memo' => 'Complete Document',
                ]);
            }

            $statusToBeBack = $assignmentdetail->status;
            $notifMessage = 'Approve Successfully';
        };

        return redirect()->back()->with('message',['status' => $statusToBeBack, 'message' => $notifMessage]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function edit(Cuti $cuti)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cuti $cuti)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cuti $cuti)
    {
        //
    }
}
