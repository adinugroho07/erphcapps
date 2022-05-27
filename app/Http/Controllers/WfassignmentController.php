<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wfassignment;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WfassignmentController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Wfassignment::class, 'wfassignment');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wfassignment = Wfassignment::where('assignstatus','ACTIVE')->paginate(7);
        $userManagerUp = User::where('status','active')->whereIn('position_category', array('VP','MGR','GM','RECRUITER'))->get();
        return Inertia::render('Assignment/ActiveAssignment',[
            'wfassignment' => $wfassignment,
            'listuser' => $userManagerUp
        ]);
    }

    public function search()
    {
        $wfassignment = Wfassignment::latest()->where('assignstatus','ACTIVE')->search(request(['search']))->paginate(7)->withQueryString();
        $userManagerUp = User::where('status','active')->whereIn('position_category', array('VP','MGR','GM','RECRUITER'))->get();
        return Inertia::render('Assignment/ActiveAssignment', [
            'wfassignment' => $wfassignment,
            'listuser' => $userManagerUp
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wfassignment  $wfassignment
     * @return \Illuminate\Http\Response
     */
    public function show(Wfassignment $wfassignment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wfassignment  $wfassignment
     * @return \Illuminate\Http\Response
     */
    public function edit(Wfassignment $wfassignment)
    {

    }

    public function deactiveAssignment(Request $request){

        Wfassignment::where('assignstatus','ACTIVE')->where('id',$request->id)->where('codetransaction',$request->codetransaction)->update([
            'assignstatus' => 'NONACTIVE'
        ]);
        return redirect()->back()->with('message','Deactive Assignment Successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wfassignment  $wfassignment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wfassignment $wfassignment)
    {
        $request->validate([
            'assignment_code'=> ['required'],
            'description'=> ['required'],
            'sequence'=> ['required'],
            'assignstatus'=> ['required'],
            'modulename'=> ['required'],
            'codetransaction'=> ['required'],
            'origperson'=> ['required'],
            'origpersonid'=> ['required'],
            'assignperson'=> ['required'],
            'assignpersonid'=> ['required'],
        ]);
        $wfassignment->update($request->only(
            'assignment_code',
            'description',
            'sequence',
            'assignstatus',
            'modulename',
            'codetransaction',
            'origperson',
            'origpersonid',
            'assignperson',
            'assignpersonid',
        ));

        return redirect()->back()->with('message','Reassign Assignment Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wfassignment  $wfassignment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wfassignment $wfassignment)
    {
        //
    }
}
