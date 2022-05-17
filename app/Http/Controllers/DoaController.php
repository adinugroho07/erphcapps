<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Assignmentdetail;
use App\Models\Doa;
use App\Models\Doahistory;
use App\Models\Organization;
use App\Models\Role;
use App\Models\User;
use App\Models\Wfassignment;
use App\Traits\WorkflowTraits;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class DoaController extends Controller
{

    use WorkflowTraits;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doa = Doa::paginate(7);
        return Inertia::render('DOA/ListDoa',[
            'doa' => $doa
        ]);
    }

    public function showApprovalPage($id){
        $doa = Doa::find($id);

        $doa->attachment1 = $doa->attachment1 == '' ? '':asset( 'storage/'.$doa->attachment1);
        $doa->attachment2 = $doa->attachment2 == '' ? '':asset( 'storage/'.$doa->attachment2);
        $assignmentnow = Wfassignment::where('assignstatus', 'ACTIVE')->where('ownertrxid',$doa->id)->first();
        $user = User::where('status','active')->get(['id','name','posname','poscode','department','department_code']);
        $assignment = Assignment::where('isactive',1)->get();;
        $doahistory = Doahistory::where('ownertrxid',$doa->id)->get();
        return Inertia::render('DOA/ApprovalDoa',[
            'doa' => $doa,
            'users' => $user,
            'assignment' => $assignment,
            'assignmentnow' => $assignmentnow,
            'doahistory' => $doahistory,
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
        $statusToBeBack = '';

        if ($request->action == 'REJECT'){
            $assignmentdetail = $this->reject(
                $request->assignment_code,
                $request->id,
                $request->status
            );

            //update status doc applicant
            $doaupdt = Doa::find($request->id);
            $doaupdt->status = 'REJECTED';
            $doaupdt->isedit = false;
            $doaupdt->save();

            $username = Auth::user()->name;

            //insert to history status
            Doahistory::create([
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
                'DOA',
                $request->applicantcode,
                'assignment/'.$request->id.'/doa/approval'
            );

            //update status doc timesheet
            $doaupdt = Doa::find($request->id);
            $doaupdt->status = $assignmentdetail->status;
            $doaupdt->isedit = false;
            if ($assignmentdetail->status == 'COMPLETE'){
                $doaupdt->is_active = true;
            }
            $doaupdt->save();

            $username = Auth::user()->name;

            //insert to history status
            Doahistory::create([
                'ownertrxid' => $request->id,
                'status' => $request->status,
                'changeby' => $username,
                'memo' => $request->memo,
            ]);

            if ($assignmentdetail->status == 'COMPLETE') {
                $doaObjct = Doa::find($request->id);
                //add or update role
                $dataRoleTobeAded = DB::table('role')->where('user_id', $doaObjct->alias_id)
                    ->whereNotExists(function ($query) use ($doaObjct) {
                        $query->select(DB::raw(1))
                            ->from('role as b')
                            ->where('b.user_id', $doaObjct->alias_acting_id)
                            ->whereColumn('role.rolecode', 'b.rolecode');
                    })->get();

                if (sizeof($dataRoleTobeAded) > 0){
                    $dataRoleInsert = [];
                    foreach ($dataRoleTobeAded as $value){
                        $dataRoleInsert[] = [
                            'rolename' => $value->rolename ,
                            'user_id' => $doaObjct->alias_acting_id ,
                            'rolecode' => $value->rolecode,
                            'roleheader_id' => $value->roleheader_id,
                            'user_name' => $doaObjct->alias_acting ,
                            'description' => 'This is Role '.$value->rolename.' From user '.$doaObjct->alias.' to be extended to this user '.$doaObjct->alias_acting ,
                            'extend' => 'EXTENDED' ,
                            'doaid' => $doaObjct->id ,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ];
                    }

                    DB::table('role')->insert($dataRoleInsert);
                }

                //update assignment
                Assignmentdetail::where('assignmetoid',$doaObjct->alias_id)->where('origpersonid',$doaObjct->alias_id)->update([
                    'delegateto' => $doaObjct->alias_acting,
                    'delegatetoid' => $doaObjct->alias_acting_id
                ]);

                //update wfassingment yang active
                Wfassignment::where('assignstatus', 'ACTIVE')->where('assignpersonid',$doaObjct->alias_id)->update([
                    'assignperson' => $doaObjct->alias_acting,
                    'assignpersonid' => $doaObjct->alias_acting_id
                ]);

                Doahistory::create([
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doaid = Doa::max('id');
        $setCodeDoa = '';
        if($doaid){
            //if not null then
            $setCodeDoa = 'DOA'.$doaid+1;
        } else {
            //if null then
            $setCodeDoa = 'DOA1';
        }
        $department = Organization::distinct()->get(['org_code','org_name']);
        $position = Organization::all('position_title','position_code','org_code','org_name');
        $user = User::where('status','active')->get(['id','name','posname','poscode','department','department_code']);
        $assignment = Assignment::where('isactive',1)->get();;
        return Inertia::render('DOA/DOACreate',[
            'users' => $user,
            'department' => $department,
            'position' => $position,
            'assignment' => $assignment,
            'codedoa' => $setCodeDoa,
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
            'justification' => ['required'] ,
            'assignment_code' => ['required'] ,
            'assignment_id' => ['required'] ,
            'status' => ['required'] ,
            'isedit' => ['required'] ,
            'doacode' => ['required','unique:doa'] ,
            'oridepartment' => ['required'] ,
            'oriposition' => ['required'] ,
            'alias' => ['required'] ,
            'alias_id' => ['required'] ,
            'alias_acting' => ['required'] ,
            'alias_acting_id' => ['required'] ,
            'start_date' => ['required'] ,
            'end_date' => ['required'] ,
            'created_by' => ['required'] ,
        ]);

        //cek dulu apakah user yang akan membuat DOA ini sedang di dalam DOA yang active.
        $isExistFrom = Doa::where('is_active', 1)->where('alias_id', $request->alias_id)->orWhere('alias_acting_id',$request->alias_id)->first();
        $isExistTo = Doa::where('is_active', 1)->where('alias_id', $request->alias_acting_id)->orWhere('alias_acting_id',$request->alias_acting_id)->first();

        if($isExistFrom != null){
            throw ValidationException::withMessages(['doa' => 'This User '.$request->alias.' Has Already In Active DOA Period !!']);
        }

        if($isExistTo != null){
            throw ValidationException::withMessages(['doa' => 'This User '.$request->alias_acting.' Has Already In Active DOA Period !!']);
        }

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
            'justification' => $request->justification ,
            'assignment_code' => $request->assignment_code ,
            'assignment_id' => $request->assignment_id ,
            'status' => $request->status ,
            'isedit' => $request->isedit ,
            'doacode' => $request->doacode ,
            'oridepartment' => $request->oridepartment ,
            'oriposition' => $request->oriposition ,
            'alias' => $request->alias ,
            'alias_id' => $request->alias_id ,
            'alias_acting' => $request->alias_acting ,
            'alias_acting_id' => $request->alias_acting_id ,
            'start_date' => Carbon::parse($request->start_date)->format('Y-m-d') ,
            'end_date' => Carbon::parse($request->end_date)->format('Y-m-d') ,
            'created_by' => $request->created_by ,
            'is_active' => $request->is_active ,
            'attachment1' => '' ,
            'attachment2' => '' ,
        ];

        if($request->file('attachment1') != null){
            $data['attachment1'] = $request->file('attachment1')->storeAs('Doa/'.$request->doacode,'DOA_'.$request->doacode.'.'.$request->file('attachment1')->extension());
        }

        if($request->file('attachment2') != null){
            $data['attachment2'] = $request->file('attachment2')->storeAs('Doa/'.$request->doacode,'DOA_'.$request->doacode.'.'.$request->file('attachment2')->extension());
        }

        $objectDoa = Doa::create($data);

        $assignmentdetail = $this->init(
            $request->assignment_code,
            $request->assignment_id,
            $objectDoa->id,
            'DOA',
            $objectDoa->doacode,
            'assignment/'.$objectDoa->id.'/doa/approval'
        );

        //update status doc timesheet ke status selanjut nya.
        $timsheetupdt = Doa::find($objectDoa->id);
        $timsheetupdt->status = $assignmentdetail->status;
        $timsheetupdt->isedit = true;
        $timsheetupdt->save();

        $username = Auth::user()->name;

        //insert to history status
        Doahistory::create([
            'ownertrxid' => $objectDoa->id,
            'status' => $objectDoa->status,
            'changeby' => $username,
            'memo' => 'initial DRAFT Status',
        ]);

//        return redirect()->back()->with('message','Successfully Created Delegation Of Authority And Route');
        return redirect()->back()->with('message',['status' => $assignmentdetail->status, 'message' => 'Successfully Created Delegation Of Authority And Route']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doa  $doa
     * @return \Illuminate\Http\Response
     */
    public function show(Doa $doa)
    {
        $doa->attachment1 = $doa->attachment1 == '' ? '':asset( 'storage/'.$doa->attachment1);
        $doa->attachment2 = $doa->attachment2 == '' ? '':asset( 'storage/'.$doa->attachment2);
        $assignmentnow = Wfassignment::where('assignstatus', 'ACTIVE')->where('ownertrxid',$doa->id)->first();
        $user = User::where('status','active')->get(['id','name','posname','poscode','department','department_code']);
        $assignment = Assignment::where('isactive',1)->get();;
        $doahistory = Doahistory::where('ownertrxid',$doa->id)->get();
        return Inertia::render('DOA/ShowDoa',[
            'doa' => $doa,
            'users' => $user,
            'assignment' => $assignment,
            'assignmentnow' => $assignmentnow,
            'doahistory' => $doahistory,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doa  $doa
     * @return \Illuminate\Http\Response
     */
    public function edit(Doa $doa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doa  $doa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doa $doa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doa  $doa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doa $doa)
    {
        //
    }
}
