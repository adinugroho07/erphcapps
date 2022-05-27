<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Assignmentdetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AssignmentController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Assignment::class, 'assignment');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assignment = Assignment::paginate(7);
        return Inertia::render('Assignment/ListAssignment',[
            'assignmentlist' => $assignment,
        ]);
    }

    public function search()
    {
        $assignment = Assignment::latest()->search(request(['search']))->paginate(7)->withQueryString();

        return Inertia::render('Assignment/ListAssignment', [
            'assignmentlist' => $assignment,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userManagerUp = User::where('status','active')->whereIn('position_category', array('VP','MGR','GM','RECRUITER'))->get();
        return Inertia::render('Assignment/CreateAssignment',[
            'listuser' => $userManagerUp
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
            'assignment_code' => ['required','unique:App\Models\Assignment,assignment_code'],
            'assignment_name' => ['required','max:100'],
            'assignment_description' => ['required','max:255'],
            'rowData' => ['required','array']
        ],[
            'rowData.required' => 'Please Add Assignment Detail Atleast One'
        ]);

        $assignment = Assignment::create([
            'assignment_code' => $request->assignment_code,
            'assignment_name' => $request->assignment_name,
            'assignment_description' => $request->assignment_description,
            'isactive' => $request->isactive
        ]);

        $data = [];
        foreach ($request->rowData as $value){
            $data[] = [
                'assignment_id' => $assignment->id,
                'assignment_code' => $assignment->assignment_code,
                'assignment_description' => $value['assignment_description'],
                'sequence' => $value['sequence'],
                'status' => $value['status'],
                'assignmeto' => $value['assignmeto'],
                'assignmetoid' => $value['assignmetoid'],
                'delegateto' => $value['delegateto'],
                'delegatetoid' => $value['delegatetoid'],
                'apprnote' => $value['apprnote'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        Assignmentdetail::insert($data);

        return redirect()->route('assignment.index')->with('message','Create Assignment Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function show(Assignment $assignment)
    {
        $assignmentdetail = Assignmentdetail::where('assignment_id', $assignment->id)->get();
        return Inertia::render('Assignment/ShowAssignment',[
            'assignment' => $assignment,
            'assignmentdetail' => $assignmentdetail
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function edit(Assignment $assignment)
    {
        $userManagerUp = User::where('status','active')->whereIn('position_category', array('VP','MGR','GM','RECRUITER'))->get();
        $assignmentdetail = Assignmentdetail::where('assignment_id', $assignment->id)->get();
        return Inertia::render('Assignment/EditAssignment',[
            'assignment' => $assignment,
            'assignmentdetail' => $assignmentdetail,
            'listuser' => $userManagerUp
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assignment $assignment)
    {
        $request->validate([
            'assignment_code' => ['required'],
            'assignment_name' => ['required','max:100'],
            'assignment_description' => ['required','max:255'],
            'rowData' => ['required','array']
        ],[
            'rowData.required' => 'Please Add Assignment Detail Atleast One'
        ]);


        $assignment->assignment_code = $request->assignment_code;
        $assignment->assignment_name = $request->assignment_name;
        $assignment->assignment_description = $request->assignment_description;
        $assignment->isactive = $request->isactive;
        $assignment->save();

        //delete ing assignment detail
        Assignmentdetail::where('assignment_id',$assignment->id)->delete();

        $data = [];
        foreach ($request->rowData as $value){
            $data[] = [
                'assignment_id' => $assignment->id,
                'assignment_code' => $request->assignment_code,
                'assignment_description' => $value['assignment_description'],
                'sequence' => $value['sequence'],
                'status' => $value['status'],
                'assignmeto' => $value['assignmeto'],
                'assignmetoid' => $value['assignmetoid'],
                'delegateto' => $value['delegateto'],
                'delegatetoid' => $value['delegatetoid'],
                'apprnote' => $value['apprnote'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        Assignmentdetail::insert($data);

        return redirect()->route('assignment.index')->with('message','Update Assignment Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignment $assignment)
    {
        //
    }
}
