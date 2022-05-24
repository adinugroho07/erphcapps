<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Resign;
use App\Models\Resignhistory;
use App\Models\User;
use App\Models\Wfassignment;
use App\Traits\WorkflowTraits;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class ResignController extends Controller
{

    use WorkflowTraits;

    public function __construct()
    {
        $this->authorizeResource(Resign::class, 'resign');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        $resign = Resign::where('created_byid', $id)->paginate(7);
        return Inertia::render('Resign/ListResign',[
            'resign' => $resign
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $resignid = Resign::max('id');
        $setCodeResign = '';
        if($resignid){
            //if not null then
            $setCodeResign = 'RESG'.$resignid+1;
        } else {
            //if null then
            $setCodeResign = 'RESG1';
        }
        $assignment = Assignment::where('isactive',1)->get();
        return Inertia::render('Resign/CreateResign',[
           'coderesign' =>  $setCodeResign,
            'assignment' => $assignment
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
            'resigncode' => ['required','unique:resign'],
            'isedit' => ['required'],
            'department' => ['required'],
            'department_code' => ['required'],
            'posname' => ['required'],
            'poscode' => ['required'],
            'name' => ['required'],
            'email' => ['required'],
            'description' => ['required'],
            'nik' => ['required'],
            'startwork' => ['required'],
            'endwork' => ['required'],
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
            'resigncode' => $request->resigncode ,
            'isedit' => $request->isedit ,
            'department' => $request->department ,
            'department_code' => $request->department_code ,
            'posname' => $request->posname ,
            'poscode' => $request->poscode ,
            'name' => $request->name ,
            'email' => $request->email ,
            'description' => $request->description ,
            'nik' => $request->nik ,
            'startwork' => Carbon::parse($request->startwork)->format('Y-m-d')  ,
            'endwork' => Carbon::parse($request->endwork)->format('Y-m-d') ,
            'created_by' => $request->created_by ,
            'created_byid' => $request->created_byid ,
            'attachment1' => '' ,
            'attachment2' => '' ,
        ];

        if($request->file('attachment1') != null){
            $data['attachment1'] = $request->file('attachment1')->storeAs('Resign/'.$request->resigncode,'RESIGN_'.$request->resigncode.'.'.$request->file('attachment1')->extension());
        }

        if($request->file('attachment2') != null){
            $data['attachment2'] = $request->file('attachment2')->storeAs('Resign/'.$request->resigncode,'RESIGN_'.$request->resigncode.'.'.$request->file('attachment2')->extension());
        }

        $resignObjt = Resign::create($data);

        $assignmentdetail = $this->init(
            $request->assignment_code,
            $request->assignment_id,
            $resignObjt->id,
            'RESIGN',
            $resignObjt->resigncode,
            'assignment/'.$resignObjt->id.'/resign/approval'
        );

        //update status doc timesheet ke status selanjut nya.
        $timsheetupdt = Resign::find($resignObjt->id);
        $timsheetupdt->status = $assignmentdetail->status;
        $timsheetupdt->isedit = false;
        $timsheetupdt->save();

        $username = Auth::user()->name;

        //insert to history status
        Resignhistory::create([
            'ownertrxid' => $resignObjt->id,
            'status' => $resignObjt->status,
            'changeby' => $username,
            'memo' => 'initial DRAFT Status',
        ]);

        return redirect()->back()->with('message',['status' => $assignmentdetail->status, 'message' => 'Successfully Create Resign Form And Route']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resign  $resign
     * @return \Illuminate\Http\Response
     */
    public function show(Resign $resign)
    {
        $resign->attachment1 = $resign->attachment1 == '' ? '':asset( 'storage/'.$resign->attachment1);
        $resign->attachment2 = $resign->attachment2 == '' ? '':asset( 'storage/'.$resign->attachment2);
        $resignhistory = Resignhistory::where('ownertrxid',$resign->id)->get();
        $assignment = Assignment::where('isactive',1)->get();
        $wfassignment = Wfassignment::where('assignstatus', 'ACTIVE')->where('ownertrxid',$resign->id)->first();
        return Inertia::render('Resign/ResignShow',[
            'resign' => $resign,
            'resignhistory' => $resignhistory,
            'assignment' => $assignment,
            'assignmentnow' => $wfassignment,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resign  $resign
     * @return \Illuminate\Http\Response
     */
    public function edit(Resign $resign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resign  $resign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resign $resign)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resign  $resign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resign $resign)
    {
        //
    }

    public function showApprovalPage($id){

        $this->authorize('approveShow', Resign::class);

        $resign = Resign::find($id);

        $resign->attachment1 = $resign->attachment1 == '' ? '':asset( 'storage/'.$resign->attachment1);
        $resign->attachment2 = $resign->attachment2 == '' ? '':asset( 'storage/'.$resign->attachment2);
        $assignmentnow = Wfassignment::where('assignstatus', 'ACTIVE')->where('ownertrxid',$resign->id)->first();
        $assignment = Assignment::where('isactive',1)->get();
        $resignhistory = Resignhistory::where('ownertrxid',$resign->id)->get();
        return Inertia::render('Resign/ApproveResign',[
            'resign' => $resign,
            'assignment' => $assignment,
            'assignmentnow' => $assignmentnow,
            'resignhistory' => $resignhistory,
        ]);
    }

    public function storeApproval(Request $request){

        $this->authorize('approveStore', Resign::class);

        $request->validate([
            'resigncode' => ['required'],
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
            $resignupdt = Resign::find($request->id);
            $resignupdt->status = 'REJECTED';
            $resignupdt->isedit = false;
            $resignupdt->save();

            $username = Auth::user()->name;

            //insert to history status
            Resignhistory::create([
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
                'RESIGN',
                $request->cuticode,
                'assignment/'.$request->id.'/resign/approval'
            );

            //update status doc timesheet
            $resignupdt = Resign::find($request->id);
            $resignupdt->status = $assignmentdetail->status;
            $resignupdt->isedit = false;
            $resignupdt->save();

            $username = Auth::user()->name;

            //insert to history status
            Resignhistory::create([
                'ownertrxid' => $request->id,
                'status' => $request->status,
                'changeby' => $username,
                'memo' => $request->memo,
            ]);

            if ($assignmentdetail->status == 'COMPLETE') {
                Resignhistory::create([
                    'ownertrxid' => $request->id,
                    'status' => $assignmentdetail->status,
                    'changeby' => $username,
                    'memo' => 'Complete Document',
                ]);
                $objectResign = Resign::find($request->id);
                User::where('id',$objectResign->created_byid)->update([
                    'status' => 'nonactive'
                ]);
            }

            $statusToBeBack = $assignmentdetail->status;
            $notifMessage = 'Approve Successfully';
        };

        return redirect()->back()->with('message',['status' => $statusToBeBack, 'message' => $notifMessage]);
    }
}
