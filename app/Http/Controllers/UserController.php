<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Organization;
use App\Models\Role;
use App\Models\Timesheet;
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

    public function search(){
        $users = User::latest()->search(request(['search']))->paginate(7)->withQueryString();
        return Inertia::render('User/Index', [
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

        $userManager = User::where('status','active')->whereIn('position_category', array('VP','MGR','GM'))->get();
        $department = Organization::distinct()->get(['org_code','org_name']);
        $position = Organization::all('position_title','position_code','org_code','org_name');
        $users = User::where('status','active')->get(['id','name','backtoback','backtoback_id','posname']);
        return Inertia::render('User/Create', [
            'userManager' => $userManager,
            'department' => $department,
            'position' => $position,
            'users' => $users
        ]);
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
            'name' => ['required','string', 'max:255'],
            'email' => ['required','string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'nik' => ['required','string', 'max:255'],
            'suppervisor' => ['required'],
            'suppervisor_posname' => ['required'],
            'suppervisor_id' => ['required'],
            'position_category' => ['required'],
            'department' => ['required'],
            'department_code' => ['required'],
            'posname' => ['required'],
            'poscode' => ['required'],
            'status' => ['required'],
            'expiredcontractdate' => ['required'],
            'posstatus' => ['required'],
            'sex' => ['required'],
            'birthdate' => ['required'],
            'religion' => ['required'],
            'married' => ['required'],
            'bankkey' => ['required'],
            'bank' => ['required'],
            'address' => [ 'max:500'],
        ],[
            'bankkey.required' => 'Bank Number Field Is Required',
            'bank.required' => 'Bank Field Is Required',
            'posstatus.required' => 'Status Employee Field Is Required',
        ]);

        $data = [
            'name' => $request->name ,
            'email' => $request->email ,
            'nik' => $request->nik ,
            'password' => Hash::make($request->password) ,
            'suppervisor' => $request->suppervisor ,
            'suppervisor_posname' => $request->suppervisor_posname ,
            'suppervisor_id' => $request->suppervisor_id ,
            'position_category' => '' ,
            'department' => $request->department ,
            'department_code' => $request->department_code ,
            'posname' => $request->posname ,
            'poscode' => $request->poscode ,
            'status' => 'active' ,
            'expiredcontractdate' => Carbon::parse($request->expiredcontractdate)->format('Y-m-d H:i:s') ,
            'posstatus' => 'pekerja' ,
            'sex' => $request->sex ,
            'birthdate' => Carbon::parse($request->birthdate)->format('Y-m-d H:i:s') ,
            'religion' => $request->religion ,
            'spouse' => $request->spouse ,
            'child1' => $request->child1 ,
            'child2' => $request->child2 ,
            'child3' => $request->child3 ,
            'married' => $request->married ,
            'state' => $request->state ,
            'city' => $request->city ,
            'phonenum' => $request->phonenum ,
            'bankkey' => $request->bankkey ,
            'address' => $request->address ,
            'backtoback' => $request->backtoback ,
            'backtoback_id' => $request->backtoback_id ,
            'postalcode' => $request->postalcode ,
            'bank' => $request->bank,
            'totalhours' => 0
        ];

        User::create($data);

        return Redirect::route('users.index')->with('message', 'User Successfully Registered');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $user
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
        return Inertia::render('User/Show', [
            'userdetail' => $user,
            'roles' => $role,
            'darimana' => 'admin',
            'timesheet' => $timesheet
        ]);
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
        $users = User::where('status','active')->get(['id','name','backtoback','backtoback_id','posname']);
        return Inertia::render('Pegawai/PegawaiEdit', [
            'userdetail' => $user,
            'userManager' => $userManager,
            'department' => $department,
            'position' => $position,
            'users' => $users,
            'darimana' => 'admin'
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

    public function deactiveUser(Request $request){
        $user = User::find($request->id);
        $user->status = 'nonactive';
        $user->save();
        return redirect()->back();
    }
}
