<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Timesheet;
use App\Models\Timesheetdetail;
use App\Models\Timesheethistory;
use App\Traits\WorkflowTraits;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        //
    }

    public function showApprovalPage($id){

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
            $setCodeApplicant = 'TMSHT'.$timesheetid;
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
        $request->validate([
            'status' => ['required','max:100'],
            'timesheetcode' => ['required'],
            'assignment_id' => ['required'],
            'assignment_code' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required','string', 'email', 'max:255'],
            'description' => ['required','max:255'],
            'attachment1' => ['required', 'mimes:pdf,doc,docx', 'max:5120'],
            'attachment2' => ['required', 'mimes:pdf,doc,docx', 'max:5120'],
            'attachment3' => ['required', 'mimes:pdf,doc,docx', 'max:5120'],
            'attachment4' => ['required', 'mimes:pdf,doc,docx', 'max:5120'],
            'timesheetdetailsfix' => ['required|array|min:1']
        ],[
            'timesheetdetailsfix.required' => 'Please Fill Assignment Detail'
        ]);

        $objecttimesheet = '';
        $statusend = '';
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
            $statusend = 'HOLD';
            $notifMessage = 'Timesheet Successfully Create And Hold';
        }

        if ($request->action == 'ROUTE'){
            $isexist = Timesheet::where('timesheetcode',$request->timesheetcode)->first();

            if ($isexist){
                // kalo get data nyaa not found maka dia akan create
                //create applicant
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
            $timsheetupdt->isedit = false;
            $timsheetupdt->save();

            $username = Auth::user()->name;

            //insert to history status
            Timesheethistory::create([
                'ownertrxid' => $objecttimesheet->id,
                'status' => $objecttimesheet->status,
                'changeby' => $username,
                'memo' => 'initial DRAFT Status',
            ]);

            $statusend = $assignmentdetail->status;
            $notifMessage = 'Timesheet Successfully Create And Route';
        }
        return redirect()->back()->with(['message' => $notifMessage, 'status' => $statusend]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Timesheet  $timesheet
     * @return \Illuminate\Http\Response
     */
    public function show(Timesheet $timesheet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Timesheet  $timesheet
     * @return \Illuminate\Http\Response
     */
    public function edit(Timesheet $timesheet)
    {
        //
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
        //
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
        $timesheet = Timesheet::create([
            'assignment_code' => $request->assignment_code ,
            'assignment_id' => $request->assignment_id ,
            'status' => $request->status ,
            'timesheetcode' => $request->timesheetcode ,
            'isedit' => $request->isedit ,
            'name' => $request->name ,
            'email' => $request->email ,
            'description' => $request->description ,
            'periode' => $request->periode ,
            'attachment1' => $request->file('attachment1')->storeAs('Timesheet','TMSHT1_'.$request->timesheetcode.'.'.$request->file('attachment1')->extension()),
            'attachment2' => $request->file('attachment2')->storeAs('Timesheet','TMSHT2_'.$request->timesheetcode.'.'.$request->file('attachment2')->extension()),
            'attachment3' => $request->file('attachment3')->storeAs('Timesheet','TMSHT3_'.$request->timesheetcode.'.'.$request->file('attachment3')->extension()),
            'attachment4' => $request->file('attachment4')->storeAs('Timesheet','TMSHT4_'.$request->timesheetcode.'.'.$request->file('attachment4')->extension()),
        ]);

        $data = [];
        foreach ($request->timesheetdetailsfix as $value){
            $data[] = [
                'timesheet_id' => $timesheet->id,
                'workstatus' =>  $value->workstatus,
                'tanggal' => $value->tanggal,
                'starthours' => $value->starthours,
                'endhours' => $value->endhours,
                'totalhours' => $value->totalhours,
                'hadir' => $value->hadir,
                'worklocation' => $value->worklocation,
                'remarks' => $value->remarks,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        Timesheetdetail::insert($data);

        return $timesheet;
    }
}
