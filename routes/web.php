<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\DoaController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ResignController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoleheaderController;
use App\Http\Controllers\TimesheetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WfassignmentController;
use App\Models\Absen;
use App\Models\Wfassignment;
use Carbon\Carbon;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

    $assignment = Wfassignment::where('assignpersonid',Auth::id())->where('assignstatus', 'ACTIVE')->get();
    $absen = Absen::where('user_id',Auth::id())->whereDate('created_at','=',Carbon::today()->toDateString())->first();
    $isAbsenDone = false;
    if ($absen != null){
        $isAbsenDone = true;
    }
    return Inertia::render('Dashboard',[
        'assignment' => $assignment,
        'absen' => $isAbsenDone
    ]);
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->resource('users', UserController::class);

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::post('users/data/deactive',[UserController::class, 'deactiveUser'])->name('users.deactive');

    //pada method resource('nama path nya','controller class'). pada parameter ke dua expect nya string bukan array.
    Route::resource('applicant', ApplicantController::class);

    Route::get('applicant/user/createuser',[ApplicantController::class, 'createUser'])->name('applicant.createuser');
    Route::get('applicant/user/listcreateuser',[ApplicantController::class, 'showlistcreate'])->name('applicant.listcreateuser');
    Route::post('applicant/user/createuser',[ApplicantController::class, 'storeUser'])->name('applicant.storeuser');
});


Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::resource('assignment',AssignmentController::class);
    Route::resource('wfassignment',WfassignmentController::class);
    Route::post('wfassignment/deactive/activeassignment', [WfassignmentController::class, 'deactiveAssignment'])->name('wfassignment.deactive');
    Route::resource('timesheet',TimesheetController::class);
    Route::get('/timesheet/all/data',[TimesheetController::class, 'getAllTimeSheet'])->name('timesheet.all');
});

//approval URL
Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    //get approval page
    Route::get('/assignment/{id}/applicant/approval',[ApplicantController::class, 'showApprovalPage'])->name('assignapplicant.show');
    Route::get('/assignment/{id}/timesheet/approval',[TimesheetController::class, 'showApprovalPage'])->name('assigntimesheet.show');
    Route::get('/assignment/{id}/doa/approval',[DoaController::class, 'showApprovalPage'])->name('assigndoa.show');
    Route::get('/assignment/{id}/cuti/approval',[CutiController::class, 'showApprovalPage'])->name('assigncuti.show');
    Route::get('/assignment/{id}/resign/approval',[ResignController::class, 'showApprovalPage'])->name('assignresign.show');
    Route::get('/assignment/{id}/mutasi/approval',[MutasiController::class, 'showApprovalPage'])->name('assignmutasi.show');
    //post approval page
    Route::post('/assignment/applicant/approval',[ApplicantController::class, 'storeApproval'])->name('applicant.approve');
    Route::post('/assignment/timesheet/approval',[TimesheetController::class, 'storeApproval'])->name('timesheet.approve');
    Route::post('/assignment/doa/approval',[DoaController::class, 'storeApproval'])->name('doa.approve');
    Route::post('/assignment/cuti/approval',[CutiController::class, 'storeApproval'])->name('cuti.approve');
    Route::post('/assignment/resign/approval',[ResignController::class, 'storeApproval'])->name('resign.approve');
    Route::post('/assignment/mutasi/approval',[MutasiController::class, 'storeApproval'])->name('mutasi.approve');

    //Route::get('/assignment/{id}/asdasd/approval',[ApplicantController::class, 'showApprovalPage']);
    //Route::post('/assignment/asdasd/approval',[ApplicantController::class, 'storeApproval']);

});

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    //pada method resource('nama path nya','controller class'). pada parameter ke dua expect nya string bukan array.
    Route::resource('roleheader', RoleheaderController::class);

    //search
    Route::post('role/search', [RoleheaderController::class, 'search'])->name('searchrole');
    Route::post('applicant/search', [ApplicantController::class, 'search'])->name('searchapplicant');
    Route::post('mutasi/search', [MutasiController::class, 'search'])->name('searchmutasi');
    Route::post('timesheet/search', [TimesheetController::class, 'search'])->name('searchtimesheet');
    Route::post('timesheet/searchwithactivelogin', [TimesheetController::class, 'searchWithActiveLogin'])->name('searchtimesheetwithactivelogin');
    Route::post('doa/search', [DoaController::class, 'search'])->name('searchdoa');
    Route::post('users/search', [UserController::class, 'search'])->name('searchusers');
    Route::post('pegawai/search', [PegawaiController::class, 'search'])->name('searchpegawai');
    Route::post('cuti/search', [CutiController::class, 'search'])->name('searchcuti');
    Route::post('assignment/search', [AssignmentController::class, 'search'])->name('searchassignment');
    Route::post('wfassignment', [WfassignmentController::class, 'search'])->name('searchwfassignment');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    //pada method resource('nama path nya','controller class'). pada parameter ke dua expect nya string bukan array.
    Route::resource('pegawai',PegawaiController::class)->parameters(['pegawai' => 'user']);
    Route::resource('doa',DoaController::class);
    Route::resource('cuti',CutiController::class);
    Route::resource('resign',ResignController::class);
    Route::resource('mutasi',MutasiController::class);
});

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::resource('absenrsc' , AbsenController::class);
    Route::post('search', [AbsenController::class, 'search'])->name('searchabsen');
    Route::post('searchwithactivelogin', [AbsenController::class, 'searchWithActiveLogin'])->name('searchabsenwithactivelogin');
    Route::get('allabsen',[AbsenController::class, 'viewDataAllAbsen'])->name('absenrsc.all');
});

Route::middleware(['auth:sanctum', 'verified'])->prefix('pegawai')->group(function(){
    Route::get('/orgchart',[AbsenController::class, 'showOrgChart'])->name('orgchart');
});

Route::prefix('email')->group(function(){
    Route::get('/show', [EmailController::class, 'show']);
    Route::get('/send', [EmailController::class, 'send']);
});



/*
route model binding -> Route::get('/users/{user:email}', [UserController::class, 'show']);
secara default binding pada path {user} akan me lookup id pada model user. jika kita ingin supaya laravel me lookup
value yang lain seperti email maka kita cukup definisikan kolom mana yang akan kita lookup,
cth -> {user:email}  , maka laravel akan me lookup email sebagai find nya.
 */
