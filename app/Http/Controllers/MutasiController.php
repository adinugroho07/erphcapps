<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Mutasi;
use App\Models\Mutasihistory;
use App\Models\Organization;
use App\Models\User;
use App\Models\Wfassignment;
use App\Traits\WorkflowTraits;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class MutasiController extends Controller
{

    use WorkflowTraits;

    public function __construct()
    {
        $this->authorizeResource(Mutasi::class, 'mutasi');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mutasi = Mutasi::where('created_byid',Auth::id())->paginate(7);
        return Inertia::render('Mutasi/MutasiIndex',[
            'mutasi' => $mutasi
        ]);
    }

    public function search()
    {
        $mutasi = Mutasi::latest()->where('created_byid',Auth::id())->search(request(['search']))->paginate(7)->withQueryString();

        return Inertia::render('Mutasi/MutasiIndex', [
            'mutasi' => $mutasi,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $codemutasi = Mutasi::max('id');
        $setCodeMutasi = '';
        if($codemutasi){
            //if not null then
            $setCodeMutasi = 'TRFJB'.$codemutasi+1;
        } else {
            //if null then
            $setCodeMutasi = 'TRFJB1';
        }
        $assignment = Assignment::where('isactive',1)->get();
        $user = User::where('status','active')->get();
        $department = Organization::distinct()->get(['org_code','org_name']);
        $position = Organization::all('position_title','position_code','org_code','org_name');
        return Inertia::render('Mutasi/MutasiCreate', [
            'codemutasi' => $setCodeMutasi,
            'assignment' => $assignment,
            'users' => $user,
            'department' => $department,
            'position' => $position,
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
            'mutasicode' => ['required','unique:mutasi'],
            'isedit' => ['required'],
            'department'=> ['required'] ,
            'department_code'=> ['required'] ,
            'posname'=> ['required'] ,
            'poscode'=> ['required'] ,
            'username'=> ['required'] ,
            'userid'=> ['required'] ,
            'department_destination'=> ['required'] ,
            'department_code_destination'=> ['required'] ,
            'posname_destination'=> ['required'] ,
            'poscode_destination'=> ['required'] ,
            'description' => ['required'],
            'created_by' => ['required'],
            'created_byid' => ['required'],
        ]);

        //dd($request);

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
            'mutasicode' => $request->mutasicode ,
            'isedit' => $request->isedit ,
            'department' => $request->department ,
            'department_code' => $request->department_code ,
            'posname' => $request->posname ,
            'poscode' => $request->poscode ,
            'username' => $request->username ,
            'userid' => $request->userid ,
            'department_destination' => $request->department_destination ,
            'department_code_destination' => $request->department_code_destination ,
            'posname_destination' => $request->posname_destination ,
            'poscode_destination' => $request->poscode_destination ,
            'description' => $request->description ,
            'created_by' => $request->created_by ,
            'created_byid' => $request->created_byid ,
            'attachment1' => '',
            'attachment2' => '',
        ];

        if($request->file('attachment1') != null){
            $data['attachment1'] = $request->file('attachment1')->storeAs('Mutasi/'.$request->mutasicode,'MUTASI_'.$request->mutasicode.'.'.$request->file('attachment1')->extension());
        }

        if($request->file('attachment2') != null){
            $data['attachment2'] = $request->file('attachment2')->storeAs('Mutasi/'.$request->mutasicode,'MUTASI_'.$request->mutasicode.'.'.$request->file('attachment2')->extension());
        }

        $mutasiObjt = Mutasi::create($data);

        $assignmentdetail = $this->init(
            $request->assignment_code,
            $request->assignment_id,
            $mutasiObjt->id,
            'MUTASI',
            $mutasiObjt->mutasicode,
            'assignment/'.$mutasiObjt->id.'/mutasi/approval'
        );

        //update status doc timesheet ke status selanjut nya.
        $timsheetupdt = Mutasi::find($mutasiObjt->id);
        $timsheetupdt->status = $assignmentdetail->status;
        $timsheetupdt->isedit = false;
        $timsheetupdt->save();

        $username = Auth::user()->name;

        //insert to history status
        Mutasihistory::create([
            'ownertrxid' => $mutasiObjt->id,
            'status' => $mutasiObjt->status,
            'changeby' => $username,
            'memo' => 'initial DRAFT Status',
        ]);

        return redirect()->back()->with('message',['status' => $assignmentdetail->status, 'message' => 'Successfully Create Transfer Job And Route']);
    }

    public function showApprovalPage($id){

        $this->authorize('approveShow', Mutasi::class);

        $mutasi = Mutasi::find($id);

        $mutasi->attachment1 = $mutasi->attachment1 == '' ? '':asset( 'storage/'.$mutasi->attachment1);
        $mutasi->attachment2 = $mutasi->attachment2 == '' ? '':asset( 'storage/'.$mutasi->attachment2);
        $assignment = Assignment::where('isactive',1)->get();
        $user = User::where('status','active')->get();
        $wfassignment = Wfassignment::where('assignstatus', 'ACTIVE')->where('ownertrxid',$id)->first();
        $mutasihistory = Mutasihistory::where('ownertrxid',$id)->get();
        $department = Organization::distinct()->get(['org_code','org_name']);
        $position = Organization::all('position_title','position_code','org_code','org_name');
        return Inertia::render('Mutasi/MutasiApprove',[
            'mutasi' => $mutasi,
            'assignment' => $assignment,
            'users' => $user,
            'mutasihistory' => $mutasihistory,
            'assignmentnow' => $wfassignment,
            'department' => $department,
            'position' => $position,
        ]);
    }

    public function storeApproval(Request $request){

        $this->authorize('approveStore', Mutasi::class);

        $request->validate([
            'mutasicode' => ['required'],
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
            $mutasiupdt = Mutasi::find($request->id);
            $mutasiupdt->status = 'REJECTED';
            $mutasiupdt->isedit = false;
            $mutasiupdt->save();

            $username = Auth::user()->name;

            //insert to history status
            Mutasihistory::create([
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
                'MUTASI',
                $request->mutasicode,
                'assignment/'.$request->id.'/mutasi/approval'
            );

            //update status doc timesheet
            $mutasiupdt = Mutasi::find($request->id);
            $mutasiupdt->status = $assignmentdetail->status;
            $mutasiupdt->isedit = false;
            $mutasiupdt->save();

            $username = Auth::user()->name;

            //insert to history status
            Mutasihistory::create([
                'ownertrxid' => $request->id,
                'status' => $request->status,
                'changeby' => $username,
                'memo' => $request->memo,
            ]);

            if ($assignmentdetail->status == 'COMPLETE') {
                //kalo approval sudah complete maka akan melakukan update poisition dari user terkait.
                $mutasiObject = Mutasi::find($request->id);
                $userObject = User::find($mutasiObject->userid);
                $organizationObject = Organization::all();

                //update posisi dan department nyaa dulu
                $userObject->department = $mutasiObject->department_destination;
                $userObject->department_code = $mutasiObject->department_code_destination;
                $userObject->posname = $mutasiObject->posname_destination;
                $userObject->poscode = $mutasiObject->poscode_destination;

                //update position Category
                foreach ($organizationObject as $value1){
                    if($value1->position_title == $mutasiObject->posname_destination){
                        $userObject->position_category = $value1->position_category;
                    }
                }

                $isStop = true;
                $tempPosition = $mutasiObject->posname_destination;
                $supervisorid = 0;
                //selama kondisi true dia akan tetep looping, tapi kalo sudah false dia akan keluar looping.
                while($isStop){
                    foreach ($organizationObject as $value){
                        //filter pertama
                        if($value->position_title == $tempPosition && $supervisorid == 0){
                            //kalo posisinya ketemu dia ambil data supervisor.
                            $supervisorid = $value->parent_org;
                            break;
                        }

                        //ini proses pengecekan atasan
                        if($supervisorid != 0){
                            if ($value->id == $supervisorid){
                                //supervisor ketemu tapi bisa jadi dia position category nya manager up atau bukan
                                if ($value->position_category == 'MGR' || $value->position_category == 'VP' || $value->position_category == 'GM'){
                                    //jika position category nyaa manager up.

                                    //update supervisor
                                    $objtSupervisor = User::find($value->id);
                                    $userObject->suppervisor = $objtSupervisor->name;
                                    $userObject->suppervisor_posname = $value->position_title;
                                    $userObject->suppervisor_id = $objtSupervisor->id;
                                    $isStop = false;
                                    break;
                                } else {
                                    //jika position category nyaa bukan manager up.
                                    //maka id supervisor yang ketemu ini di copy kan lagi ke supervisorid untuk di cari kembali.

                                    $supervisorid = $value->id;
                                    break;
                                }
                            }
                        }
                    }
                }


                $userObject->save();

                Mutasihistory::create([
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
     * Display the specified resource.
     *
     * @param  \App\Models\Mutasi  $mutasi
     * @return \Illuminate\Http\Response
     */
    public function show(Mutasi $mutasi)
    {
        $mutasi->attachment1 = $mutasi->attachment1 == '' ? '':asset( 'storage/'.$mutasi->attachment1);
        $mutasi->attachment2 = $mutasi->attachment2 == '' ? '':asset( 'storage/'.$mutasi->attachment2);
        $assignment = Assignment::where('isactive',1)->get();
        $user = User::where('status','active')->get();
        $wfassignment = Wfassignment::where('assignstatus', 'ACTIVE')->where('ownertrxid',$mutasi->id)->first();
        $mutasihistory = Mutasihistory::where('ownertrxid',$mutasi->id)->get();
        $department = Organization::distinct()->get(['org_code','org_name']);
        $position = Organization::all('position_title','position_code','org_code','org_name');
        return Inertia::render('Mutasi/MutasiShow',[
            'mutasi' => $mutasi,
            'assignment' => $assignment,
            'users' => $user,
            'mutasihistory' => $mutasihistory,
            'assignmentnow' => $wfassignment,
            'department' => $department,
            'position' => $position,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mutasi  $mutasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Mutasi $mutasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mutasi  $mutasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mutasi $mutasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mutasi  $mutasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mutasi $mutasi)
    {
        //
    }
}
