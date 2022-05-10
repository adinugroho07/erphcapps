<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Organization;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class UserController extends Controller
{

    use PasswordValidationRules;

    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('role')->paginate(5);
        return Inertia::render('User/Index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userManager = User::whereRelation('Role', 'rolename', 'like', '%manager%')->get();
        return Inertia::render('User/Create', compact('userManager'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'department' => ['required', 'max:220'],
            'posname' => ['required', 'max:220'],
            'status' => ['required', 'max:50'],
            'suppervisor' => ['required', 'max:220'],
            'suppervisor_id' => ['required', 'max:50']
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'department' => $request->department,
            'posname' => $request->posname,
            'status' => $request->status,
            'suppervisor' => $request->suppervisor,
            'suppervisor_id' => $request->suppervisor_id
        ]);
        return Redirect::route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $role = Role::where('user_id',$user->id)->get();
        return Inertia::render('User/Show', ['userdetail' => $user,'roles' => $role]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //$userManager = User::whereRelation('Role', 'rolename', 'like', '%manager%')->get();
        //return Inertia::render('User/Edit', compact('user','userManager'));

        $userManager = User::whereIn('position_category', array('VP','MGR','GM'))->get();
        $department = Organization::distinct()->get(['org_code','org_name']);
        $position = Organization::all('position_title','position_code','org_code','org_name');
        $users = User::all('id','name','backtoback','backtoback_id','posname');
        return Inertia::render('Pegawai/PegawaiEdit', [
            'userdetail' => $user,
            'userManager' => $userManager,
            'department' => $department,
            'position' => $position,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
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

        $request->expiredcontractdate = new Carbon($request->expiredcontractdate);
        $request->birthdate = new Carbon($request->birthdate);

        $user->update($request->only(
            'name' ,
            'email' ,
            'suppervisor' ,
            'suppervisor_posname' ,
            'suppervisor_id' ,
            'position_category' ,
            'department' ,
            'department_code' ,
            'posname' ,
            'poscode' ,
            'status' ,
            'expiredcontractdate' ,
            'posstatus' ,
            'sex' ,
            'birthdate' ,
            'religion' ,
            'spouse' ,
            'child1' ,
            'child2' ,
            'child3' ,
            'married' ,
            'state' ,
            'city' ,
            'phonenum' ,
            'bankkey' ,
            'address' ,
            'backtoback' ,
            'backtoback_id' ,
            'postalcode' ,
            'bank'
        ));
        return Redirect::route('users.index')->with('message', 'Update Data Successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->status = 'nonactive';
        $user->save();
        return redirect()->back();

    }
}
