<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\DoaController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ResignController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoleheaderController;
use App\Http\Controllers\TimesheetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WfassignmentController;
use App\Models\Wfassignment;
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
    return Inertia::render('Dashboard',[
        'assignment' => $assignment
    ]);
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->resource('users', UserController::class);

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    //pada method resource('nama path nya','controller class'). pada parameter ke dua expect nya string bukan array.
    Route::resource('applicant', ApplicantController::class);
    Route::post('applicant/search', [ApplicantController::class, 'search'])->name('searchapplicant');
    Route::get('applicant/user/createuser',[ApplicantController::class, 'createUser'])->name('applicant.createuser');
    Route::get('applicant/user/listcreateuser',[ApplicantController::class, 'showlistcreate'])->name('applicant.listcreateuser');
    Route::post('applicant/user/createuser',[ApplicantController::class, 'storeUser'])->name('applicant.storeuser');
});


Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::resource('assignment',AssignmentController::class);
    Route::resource('wfassignment',WfassignmentController::class);
    Route::resource('timesheet',TimesheetController::class);
    Route::get('/timesheet/all/data',[TimesheetController::class, 'getAllTimeSheet'])->name('timesheet.all');
});

//approval URL
Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    //get approval page
    Route::get('/assignment/{id}/applicant/approval',[ApplicantController::class, 'showApprovalPage']);
    Route::get('/assignment/{id}/timesheet/approval',[TimesheetController::class, 'showApprovalPage']);
    Route::get('/assignment/{id}/doa/approval',[DoaController::class, 'showApprovalPage']);
    Route::get('/assignment/{id}/cuti/approval',[CutiController::class, 'showApprovalPage']);
    Route::get('/assignment/{id}/resign/approval',[ResignController::class, 'showApprovalPage']);
    //post approval page
    Route::post('/assignment/applicant/approval',[ApplicantController::class, 'storeApproval'])->name('applicant.approve');
    Route::post('/assignment/timesheet/approval',[TimesheetController::class, 'storeApproval'])->name('timesheet.approve');
    Route::post('/assignment/doa/approval',[DoaController::class, 'storeApproval'])->name('doa.approve');
    Route::post('/assignment/cuti/approval',[CutiController::class, 'storeApproval'])->name('cuti.approve');
    Route::post('/assignment/resign/approval',[ResignController::class, 'storeApproval'])->name('resign.approve');

    //Route::get('/assignment/{id}/asdasd/approval',[ApplicantController::class, 'showApprovalPage']);
    //Route::post('/assignment/asdasd/approval',[ApplicantController::class, 'storeApproval']);

});

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    //pada method resource('nama path nya','controller class'). pada parameter ke dua expect nya string bukan array.
    Route::resource('roleheader', RoleheaderController::class);
    Route::post('role/search', [RoleheaderController::class, 'search'])->name('searchrole');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    //pada method resource('nama path nya','controller class'). pada parameter ke dua expect nya string bukan array.
    Route::resource('pegawai',PegawaiController::class);
    Route::resource('doa',DoaController::class);
    Route::resource('cuti',CutiController::class);
    Route::resource('resign',ResignController::class);
});

Route::middleware(['auth:sanctum', 'verified'])->prefix('absen')->group(function(){
    Route::resource('absenrsc' , AbsenController::class);
    Route::post('search', [AbsenController::class, 'search'])->name('search');
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
