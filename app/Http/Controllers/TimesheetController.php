<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Timesheet;
use App\Models\Timesheetdetail;
use App\Models\Timesheethistory;
use App\Models\Wfassignment;
use App\Traits\WorkflowTraits;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class TimesheetController extends Controller
{

    use WorkflowTraits;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        $timesheet = Timesheet::where('createdbyid',$id)->orderBy('id', 'DESC')->paginate(7);
        return Inertia::render('Timesheet/ListPersonalTimeSheet',[
            'timesheet' => $timesheet
        ]);
    }

    public function getAllTimeSheet(){
        $timesheet = Timesheet::orderBy('id', 'DESC')->paginate(7);
        return Inertia::render('Timesheet/ListAllTimeSheet',[
           'timesheet' => $timesheet
        ]);
    }

    public function showApprovalPage($id){
        $timesheet = Timesheet::find($id);

        $timesheet->attachment1 = $timesheet->attachment1 == '' ? '':asset( 'storage/'.$timesheet->attachment1);
        $timesheet->attachment2 = $timesheet->attachment2 == '' ? '':asset( 'storage/'.$timesheet->attachment2);
        $timesheet->attachment3 = $timesheet->attachment3 == '' ? '':asset( 'storage/'.$timesheet->attachment3);
        $timesheet->attachment4 = $timesheet->attachment4 == '' ? '':asset( 'storage/'.$timesheet->attachment4);

        $timesheetdetail = Timesheetdetail::where('timesheet_id',$id)->get();
        $timesheethistory = Timesheethistory::where('ownertrxid',$id)->get();
        $assignmentnow = Wfassignment::where('assignstatus', 'ACTIVE')->where('ownertrxid',$id)->first();
        $assignment = Assignment::all();
        return Inertia::render('Timesheet/ApproveTimeSheet',[
            'timesheet' => $timesheet,
            'timesheetdetail' =>$timesheetdetail,
            'timesheethistory' => $timesheethistory,
            'assignment' => $assignment,
            'assignmentnow' => $assignmentnow,
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
                'TIMESHEET',
                $request->applicantcode,
                'assignment/'.$request->id.'/timesheet/approval'
            );

            //update status doc timesheet
            $timesheetupdt = Timesheet::find($request->id);
            $timesheetupdt->status = $assignmentdetail->status;
            $timesheetupdt->isedit = false;
            $timesheetupdt->save();

            $username = Auth::user()->name;

            //insert to history status
            Timesheethistory::create([
                'ownertrxid' => $request->id,
                'status' => $request->status,
                'changeby' => $username,
                'memo' => $request->memo,
            ]);

            if ($assignmentdetail->status == 'COMPLETE') {
                Timesheethistory::create([
                    'ownertrxid' => $request->id,
                    'status' => $assignmentdetail->status,
                    'changeby' => $username,
                    'memo' => 'Complete Document',
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
            $timesheetupdt = Timesheet::find($request->id);
            $timesheetupdt->status = 'REJECTED';
            $timesheetupdt->isedit = false;
            $timesheetupdt->save();

            $username = Auth::user()->name;

            //insert to history status
            Timesheethistory::create([
                'ownertrxid' => $request->id,
                'status' => 'REJECTED',
                'changeby' => $username,
                'memo' => $request->memo,
            ]);

            $notifMessage = 'Document Rejected Successfully';
        };


        $timesheet = Timesheet::find($request->id);
        $timesheetdetail = Timesheetdetail::where('timesheet_id',$request->id)->get();
        $timesheethistory = Timesheethistory::where('ownertrxid',$request->id)->get();
        $assignmentnow = Wfassignment::where('assignstatus', 'ACTIVE')->where('ownertrxid',$request->id)->first();
        $assignment = Assignment::all();

        Inertia::share('flash', session('flash', ['message' => $notifMessage]));
        return Inertia::render('Timesheet/ApproveTimeSheet',[
            'timesheet' => $timesheet,
            'timesheetdetail' =>$timesheetdetail,
            'timesheethistory' => $timesheethistory,
            'assignment' => $assignment,
            'assignmentnow' => $assignmentnow,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $timesheetid = Timesheet::max('id');
        $setCodeApplicant = '';
        if($timesheetid){
            //if not null then
            $setCodeApplicant = 'TMSHT'.$timesheetid+1;
        } else {
            //if null then
            $setCodeApplicant = 'TMSHT1';
        }

        $assignment = Assignment::all();
        return Inertia::render('Timesheet/CreateTimesheet',[
            'codetimesheet' => $setCodeApplicant,
            'assignment' => $assignment,
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

        $validateddata = $request->validate([
            'status' => ['required','max:100'],
            'timesheetcode' => ['required'],
            'assignment_id' => ['required'],
            'assignment_code' => ['required'],
            'createdby' => ['required'],
            'createdbyid' => ['required'],
            'year' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required','string', 'email', 'max:255'],
            'description' => ['required','max:255'],
            'timesheetdetailsfix' => ['required','array']
        ],[
            'timesheetdetailsfix.required' => 'Please Fill Assignment Detail'
        ]);

//      file validation
        $this->fileValidation($request);

        $objecttimesheet = '';
        $notifMessage = 'test';
        if ($request->action == 'HOLD'){
            // wf tidak berjalan.

            //create timesheet
            $objecttimesheet = $this->insertTimesheetAll($request);

            $username = Auth::user()->name;

            //insert to history status
            Timesheethistory::create([
                'ownertrxid' => $objecttimesheet->id,
                'status' => $objecttimesheet->status,
                'changeby' => $username,
                'memo' => 'Doc On Hold',
            ]);
            $notifMessage = 'Timesheet Successfully Create And Hold';
        }

        if ($request->action == 'ROUTE'){
            $isexist = Timesheet::where('timesheetcode',$request->timesheetcode)->first();


            if ($isexist == null){
                // kalo get data nyaa not found maka dia akan create
                $objecttimesheet = $this->insertTimesheetAll($request);
            } else {
                $objecttimesheet = $isexist;
            }

            // urutannya approve/init dulu -> change doc status ke status selanjutnya -> insert doc transaksi history.
            $assignmentdetail = $this->init(
                $request->assignment_code,
                $request->assignment_id,
                $objecttimesheet->id,
                'TIMESHEET',
                $objecttimesheet->timesheetcode,
                'assignment/'.$objecttimesheet->id.'/timesheet/approval'
            );

            //update status doc timesheet ke status selanjut nya.
            $timsheetupdt = Timesheet::find($objecttimesheet->id);
            $timsheetupdt->status = $assignmentdetail->status;
            $timsheetupdt->isedit = true;
            $timsheetupdt->save();

            $username = Auth::user()->name;

            //insert to history status
            Timesheethistory::create([
                'ownertrxid' => $objecttimesheet->id,
                'status' => $objecttimesheet->status,
                'changeby' => $username,
                'memo' => 'initial DRAFT Status',
            ]);

            $notifMessage = 'Timesheet Successfully Create And Route';

        }
        return redirect()->route('timesheet.index')->with('message',$notifMessage);
    }

    public function fileValidation($request){
        //validation attachment
        $isoke = true;
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

        if ($request->file('attachment3')){
            //kalo ada file yang di input
            if (
                $request->file('attachment3')->extension() == 'pdf' ||
                $request->file('attachment3')->extension() == 'doc' ||
                $request->file('attachment3')->extension() == 'docx'
            ){
                $isoke = true;
            } else {
                $isoke = false;
                throw ValidationException::withMessages(['attachment3' => 'Extension File From Attachment 3 Not Valid']);
            }

            if ($request->file('attachment1')->getSize() > 5120000){
                throw ValidationException::withMessages(['attachment3' => 'File Size From Attachment 3 Too Big, Please Upload File Below 5mb']);
            }
        }

        if ($request->file('attachment4')){
            //kalo ada file yang di input
            if (
                $request->file('attachment4')->extension() == 'pdf' ||
                $request->file('attachment4')->extension() == 'doc' ||
                $request->file('attachment4')->extension() == 'docx'
            ){
                $isoke = true;
            } else {
                $isoke = false;
                throw ValidationException::withMessages(['attachment4' => 'Extension File From Attachment 4 Not Valid']);
            }

            if ($request->file('attachment1')->getSize() > 5120000){
                throw ValidationException::withMessages(['attachment4' => 'File Size From Attachment 4 Too Big, Please Upload File Below 5mb']);
            }
        }

        return $isoke;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Timesheet  $timesheet
     * @return \Illuminate\Http\Response
     */
    public function show(Timesheet $timesheet)
    {
        //1 true , 0 false
        $timesheet->attachment1 = $timesheet->attachment1 == '' ? '':asset( 'storage/'.$timesheet->attachment1);
        $timesheet->attachment2 = $timesheet->attachment2 == '' ? '':asset( 'storage/'.$timesheet->attachment2);
        $timesheet->attachment3 = $timesheet->attachment3 == '' ? '':asset( 'storage/'.$timesheet->attachment3);
        $timesheet->attachment4 = $timesheet->attachment4 == '' ? '':asset( 'storage/'.$timesheet->attachment4);
        $timesheetdetail = Timesheetdetail::where('timesheet_id',$timesheet->id)->get();
        $timesheethistory = Timesheethistory::where('ownertrxid',$timesheet->id)->get();
        $assignment = Assignment::all();
        return Inertia::render('Timesheet/ShowTimeSheet',[
           'timesheet' => $timesheet,
            'timesheetdetail' =>$timesheetdetail,
            'timesheethistory' => $timesheethistory,
            'assignment' => $assignment
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Timesheet  $timesheet
     * @return \Illuminate\Http\Response
     */
    public function edit(Timesheet $timesheet)
    {
        $timesheet->attachment1 = $timesheet->attachment1 == '' ? '':asset( 'storage/'.$timesheet->attachment1);
        $timesheet->attachment2 = $timesheet->attachment2 == '' ? '':asset( 'storage/'.$timesheet->attachment2);
        $timesheet->attachment3 = $timesheet->attachment3 == '' ? '':asset( 'storage/'.$timesheet->attachment3);
        $timesheet->attachment4 = $timesheet->attachment4 == '' ? '':asset( 'storage/'.$timesheet->attachment4);
        $timesheetdetail = Timesheetdetail::where('timesheet_id',$timesheet->id)->get();
        $timesheethistory = Timesheethistory::where('ownertrxid',$timesheet->id)->get();
        $assignment = Assignment::all();
        return Inertia::render('Timesheet/EditTimeSheet',[
            'timesheet' => $timesheet,
            'timesheetdetail' =>$timesheetdetail,
            'timesheethistory' => $timesheethistory,
            'assignment' => $assignment
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Timesheet  $timesheet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Timesheet $timesheet)
    {
        $validateddata = $request->validate([
            'id' => ['required'],
            'status' => ['required','max:100'],
            'timesheetcode' => ['required'],
            'assignment_id' => ['required'],
            'assignment_code' => ['required'],
            'createdby' => ['required'],
            'createdbyid' => ['required'],
            'year' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required','string', 'email', 'max:255'],
            'description' => ['required','max:255'],
            'timesheetdetailsfix' => ['required','array']
        ],[
            'timesheetdetailsfix.required' => 'Please Fill Assignment Detail'
        ]);

//      file validation
        $this->fileValidation($request);

        $notifMessage = 'test';

        //update data timesheet dulu baru di route.
        $this->updateTimesheetAll($request,$timesheet);
        // urutannya approve/init dulu -> change doc status ke status selanjutnya -> insert doc transaksi history.
        $assignmentdetail = $this->init(
            $request->assignment_code,
            $request->assignment_id,
            $request->id,
            'TIMESHEET',
            $request->timesheetcode,
            'assignment/'.$request->id.'/timesheet/approval'
        );

        //update status doc timesheet ke status selanjut nya.
        $timsheetupdt = Timesheet::find($request->id);
        $timsheetupdt->status = $assignmentdetail->status;
        $timsheetupdt->isedit = true;
        $timsheetupdt->save();

        $username = Auth::user()->name;

        //insert to history status
        Timesheethistory::create([
            'ownertrxid' => $request->id,
            'status' => $request->status,
            'changeby' => $username,
            'memo' => 'initial DRAFT Status',
        ]);

        $notifMessage = 'Timesheet Successfully Edit And Route';

        return redirect()->back()->with('message',$notifMessage);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Timesheet  $timesheet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Timesheet $timesheet)
    {
        //
    }

    public function insertTimesheetAll($request){
        $dataInsert = [
            'assignment_code' => $request->assignment_code ,
            'assignment_id' => $request->assignment_id ,
            'createdby' => $request->createdby ,
            'createdbyid' => $request->createdbyid ,
            'status' => $request->status ,
            'timesheetcode' => $request->timesheetcode ,
            'isedit' => $request->isedit ,
            'name' => $request->name ,
            'email' => $request->email ,
            'description' => $request->description ,
            'periode' => $request->periode ,
            'year' => $request->year ,
            'attachment1' => '',
            'attachment2' => '',
            'attachment3' => '',
            'attachment4' => '',
        ];
        //nama file yang di upload akan di override karena jika nama file nya panjang dan tidak baku maka akan menjadi malware.
        if($request->file('attachment1') != null){
            $dataInsert['attachment1'] = $request->file('attachment1')->storeAs('Timesheet','TMSHT1_'.$request->timesheetcode.'.'.$request->file('attachment1')->extension());
        }

        if($request->file('attachment2') != null){
            $dataInsert['attachment2'] = $request->file('attachment2')->storeAs('Timesheet','TMSHT2_'.$request->timesheetcode.'.'.$request->file('attachment2')->extension());
        }

        if($request->file('attachment3') != null){
            $dataInsert['attachment3'] = $request->file('attachment3')->storeAs('Timesheet','TMSHT3_'.$request->timesheetcode.'.'.$request->file('attachment3')->extension());
        }

        if($request->file('attachment4') != null){
            $dataInsert['attachment4'] = $request->file('attachment4')->storeAs('Timesheet','TMSHT4_'.$request->timesheetcode.'.'.$request->file('attachment4')->extension());
        }

        $timesheet = Timesheet::create($dataInsert);

        $data = [];
        foreach ($request->timesheetdetailsfix as $value){
            $data[] = [
                'timesheet_id' => $timesheet->id,
                'workstatus' =>  $value['workstatus'],
                'tanggal' => Carbon::parse($value['tanggal'])->format('Y-m-d'),
                'totalhours' => $value['totalhours'],
                'hadir' => $value['hadir'],
                'worklocation' => $value['worklocation'],
                'remarks' => $value['remarks'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        DB::table('timesheet_detail')->insert($data);

        return $timesheet;
    }

    public function updateTimesheetAll($request,$timesheet){

        $timesheet->assignment_code =  $request->assignment_code  ;
        $timesheet->assignment_id =  $request->assignment_id  ;
        $timesheet->createdby =  $request->createdby  ;
        $timesheet->createdbyid =  $request->createdbyid  ;
        $timesheet->status =  $request->status  ;
        $timesheet->timesheetcode =  $request->timesheetcode  ;
        $timesheet->isedit =  $request->isedit  ;
        $timesheet->name =  $request->name  ;
        $timesheet->email =  $request->email  ;
        $timesheet->description =  $request->description  ;
        $timesheet->periode =  $request->periode  ;
        $timesheet->year =  $request->year  ;



        //nama file yang di upload akan di override karena jika nama file nya panjang dan tidak baku maka akan menjadi malware.
        if($request->file('attachment1') != null){
            //jika file tidak null maka file yang sudah di upload sebelum nya akan di replace. di hapus dulu baru di insert.
            Storage::delete(asset( 'storage/'.$timesheet->attachment1));
            $timesheet->attachment1 = $request->file('attachment1')->storeAs('Timesheet','TMSHT1_'.$request->timesheetcode.'.'.$request->file('attachment1')->extension());
        }

        if($request->file('attachment2') != null){
            //jika file tidak null maka file yang sudah di upload sebelum nya akan di replace. di hapus dulu baru di insert.
            Storage::delete(asset( 'storage/'.$timesheet->attachment2));
            $timesheet->attachment2 = $request->file('attachment2')->storeAs('Timesheet','TMSHT2_'.$request->timesheetcode.'.'.$request->file('attachment2')->extension());
        }

        if($request->file('attachment3') != null){
            //jika file tidak null maka file yang sudah di upload sebelum nya akan di replace. di hapus dulu baru di insert.
            Storage::delete(asset( 'storage/'.$timesheet->attachment3));
            $timesheet->attachment3 = $request->file('attachment3')->storeAs('Timesheet','TMSHT3_'.$request->timesheetcode.'.'.$request->file('attachment3')->extension());
        }

        if($request->file('attachment4') != null){
            //jika file tidak null maka file yang sudah di upload sebelum nya akan di replace. di hapus dulu baru di insert.
            Storage::delete(asset( 'storage/'.$timesheet->attachment4));
            $timesheet->attachment4 = $request->file('attachment4')->storeAs('Timesheet','TMSHT4_'.$request->timesheetcode.'.'.$request->file('attachment4')->extension());
        }

        $timesheet->save();

        //delete timesheet detail dulu baru di insert ulang.
        Timesheetdetail::where('timesheet_id',$timesheet->id)->delete();

        $data = [];
        foreach ($request->timesheetdetailsfix as $value){
            $data[] = [
                'timesheet_id' => $timesheet->id,
                'workstatus' =>  $value['workstatus'],
                'tanggal' => Carbon::parse($value['tanggal'])->format('Y-m-d'),
                'totalhours' => $value['totalhours'],
                'hadir' => $value['hadir'],
                'worklocation' => $value['worklocation'],
                'remarks' => $value['remarks'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        DB::table('timesheet_detail')->insert($data);

        return $timesheet;
    }
}
