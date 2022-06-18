<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Role;
use App\Models\Timesheet;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PegawaiController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('status','active')->paginate(5);
        return Inertia::render('Pegawai/PegawaiIndex', ['users' => $users]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(){

        $users = User::latest()->search(request(['search']))->paginate(7)->withQueryString();

        return Inertia::render('Pegawai/PegawaiIndex', [
            'users' => $users,
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $timesheet = Timesheet::select('timesheet.timesheetcode','timesheet.status')
            ->selectRaw('sum(timesheet_detail.totalhours) AS totalhours')
            ->join('timesheet_detail','timesheet_detail.timesheet_id','=','timesheet.id')
            ->where('createdbyid',$user->id)
            ->groupBy('timesheet.timesheetcode','timesheet.status')->get();
        $role = Role::where('user_id',$user->id)->get();
        return Inertia::render('Pegawai/PegawaiShow', [
            'userdetail' => $user,
            'roles' => $role,
            'darimana' => 'pegawai',
            'timesheet' => $timesheet
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        $this->authorize('pegawaiEdit', User::class);

        $userManager = User::where('status','active')->whereIn('position_category', array('VP','MGR','GM'))->get();
        $department = Organization::distinct()->get(['org_code','org_name']);
        $position = Organization::all('position_title','position_code','org_code','org_name');
        $users = User::where('status','active')->get(['id','name','backtoback','backtoback_id','posname']);
        return Inertia::render('Pegawai/PegawaiEdit', [
            'userdetail' => $user,
            'userManager' => $userManager,
            'department' => $department,
            'position' => $position,
            'users' => $users,
            'darimana' => 'pegawai'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' =>  ['required', 'max:150'],
            'email' =>  ['required', 'max:50'],
            'nik' =>  ['required', 'max:200'],
            'suppervisor' =>  [ 'max:225'],
            'suppervisor_posname' =>  [ 'max:225'] ,
            'position_category' =>  ['required', 'max:50'] ,
            'department' =>  ['required', 'max:225'] ,
            'department_code' =>  ['required', 'max:100'] ,
            'posname' =>  ['required', 'max:225'] ,
            'poscode' =>  ['required', 'max:100'] ,
            'status' =>  ['required', 'max:100'] ,
            'posstatus' =>  ['required', 'max:100'] ,
            'sex' =>  ['max:50'] ,
            'religion' =>  ['max:100'] ,
            'spouse' =>  ['max:200'] ,
            'child1' =>  [ 'max:200'] ,
            'child2' =>  [ 'max:200'] ,
            'child3' =>  ['max:200'] ,
            'state' =>  ['max:225'],
            'city' =>  ['max:225'],
            'phonenum' =>  ['max:100'] ,
            'bankkey' =>   ['max:100'] ,
            'address' =>   ['max:300'] ,
            'backtoback' =>  ['max:300'] ,
            'postalcode' =>  ['max:100'] ,
            'bank' =>  [ 'max:100']
        ]);


        $user->suppervisor =   $request->suppervisor;
        $user->suppervisor_posname =   $request->suppervisor_posname ;
        $user->suppervisor_id =   $request->suppervisor_id ;
        $user->position_category =   $request->position_category ;
        $user->department =   $request->department ;
        $user->department_code =   $request->department_code ;
        $user->posname =   $request->posname ;
        $user->poscode =   $request->poscode ;
        $user->status =   $request->status ;
        $user->expiredcontractdate =   new Carbon($request->expiredcontractdate) ;
        $user->posstatus =   $request->posstatus ;
        $user->sex =   $request->sex ;
        $user->birthdate =   new Carbon($request->birthdate) ;
        $user->religion =   $request->religion ;
        $user->spouse =   $request->spouse ;
        $user->child1 =   $request->child1 ;
        $user->child2 =   $request->child2 ;
        $user->child3 =   $request->child3 ;
        $user->married =   $request->married ;
        $user->state =   $request->state ;
        $user->city =   $request->city ;
        $user->phonenum =   $request->phonenum ;
        $user->bankkey =   $request->bankkey ;
        $user->address =   $request->address ;
        $user->backtoback =   $request->backtoback ;
        $user->backtoback_id =   $request->backtoback_id ;
        $user->postalcode =   $request->postalcode ;
        $user->bank =   $request->bank ;
        $user->save();

        return redirect()->back()->with('message', 'Update Data Successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
