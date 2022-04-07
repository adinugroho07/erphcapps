<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Role;
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
        $users = User::paginate(5);
        return Inertia::render('Pegawai/PegawaiIndex', ['users' => $users]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::where('id', $id)->first();
        $role = Role::where('user_id',$id)->get();
        return Inertia::render('Pegawai/PegawaiShow', ['userdetail' => $users,'roles' => $role]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::where('id', $id)->first();
        $userManager = User::whereIn('position_category', array('VP','MGR','GM'))->get();
        $department = Organization::distinct()->get(['org_code','org_name']);
        $position = Organization::all('position_title','position_code','org_code','org_name');
        $user = User::all('id','name','backtoback','backtoback_id','posname');
        return Inertia::render('Pegawai/PegawaiEdit', [
            'userdetail' => $users,
            'userManager' => $userManager,
            'department' => $department,
            'position' => $position,
            'users' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' =>  ['required', 'max:150'],
            'email' =>  ['required', 'max:50'],
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

        User::where('id', $id)->update([
            'name' =>  $request->name,
            'email' =>  $request->email,
            'suppervisor' =>  $request->suppervisor,
            'suppervisor_posname' =>  $request->suppervisor_posname ,
            'suppervisor_id' =>  $request->suppervisor_id ,
            'position_category' =>  $request->position_category ,
            'department' =>  $request->department ,
            'department_code' =>  $request->department_code ,
            'posname' =>  $request->posname ,
            'poscode' =>  $request->poscode ,
            'status' =>  $request->status ,
            'expiredcontractdate' =>  new Carbon($request->expiredcontractdate) ,
            'posstatus' =>  $request->posstatus ,
            'sex' =>  $request->sex ,
            'birthdate' =>  new Carbon($request->birthdate) ,
            'religion' =>  $request->religion ,
            'spouse' =>  $request->spouse ,
            'child1' =>  $request->child1 ,
            'child2' =>  $request->child2 ,
            'child3' =>  $request->child3 ,
            'married' =>  $request->married ,
            'state' =>  $request->state ,
            'city' =>  $request->city ,
            'phonenum' =>  $request->phonenum ,
            'bankkey' =>  $request->bankkey ,
            'address' =>  $request->address ,
            'backtoback' =>  $request->backtoback ,
            'backtoback_id' =>  $request->backtoback_id ,
            'postalcode' =>  $request->postalcode ,
            'bank' =>  $request->bank ,
        ]);

        return redirect()->back()->with('message', 'Update Data Successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
