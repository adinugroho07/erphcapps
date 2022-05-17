<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Roleheader;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class RoleheaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roleheader = Roleheader::paginate(5);
        return Inertia::render('Role/IndexRole', compact('roleheader'));
    }

    public function search(){

        $roles = Roleheader::latest()->search(request(['search']))->paginate(7);
        return Inertia::render('Role/IndexRole', compact('roles'));
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
     * @param  \App\Models\Roleheader  $roleheader
     * @return \Illuminate\Http\Response
     */
    public function show(Roleheader $roleheader)
    {
        $roledetail = Role::where('roleheader_id',$roleheader->id)->get();
        return Inertia::render('Role/RoleShow',[
            'roleheader' => $roleheader,
            'roledetail' => $roledetail
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Roleheader  $roleheader
     * @return \Illuminate\Http\Response
     */
    public function edit(Roleheader $roleheader)
    {
        $user = User::where('status','active')->get();
        $roledetail = Role::where('roleheader_id',$roleheader->id)->get();
        return Inertia::render('Role/EditRole',[
            'user' => $user,
            'roleheader' => $roleheader,
            'roledetail' => $roledetail
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Roleheader  $roleheader
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Roleheader $roleheader)
    {
        $request->validate([
            'rolecode' => ['required'],
            'rolename' => ['required','max:100'],
            'description' => ['required','max:255'],
            'created_by' => ['required','max:255'],
            'rowData' => ['required','array']
        ],[
            'rowData.required' => 'Please Add User Atleast One'
        ]);

        $roleheader->rolecode = $request->rolecode;
        $roleheader->rolename = $request->rolename;
        $roleheader->description = $request->description;
        $roleheader->created_by = $request->created_by;
        $roleheader->created_byid = $request->created_byid;
        $roleheader->save();

        //delete role detail base on id roleheader, exclude extend from DOA
        Role::where('roleheader_id',$request->id)->where('extend','')->delete();

        $data = [];
        foreach ($request->rowData as $value){
            if ($value['extend'] != 'EXTENDED'){
                $data[] = [
                    'rolename' => $value['rolename'],
                    'user_id' => $value['user_id'],
                    'rolecode' => $value['rolecode'],
                    'roleheader_id' => $value['roleheader_id'],
                    'user_name' => $value['user_name'],
                    'description' => $value['description'],
                    'extend' => $value['extend'],
                    'doaid' => $value['doaid'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }
        DB::table('role')->insert($data);

        return redirect()->back()->with('message','Update Role Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Roleheader  $roleheader
     * @return \Illuminate\Http\Response
     */
    public function destroy(Roleheader $roleheader)
    {
        //
    }
}
