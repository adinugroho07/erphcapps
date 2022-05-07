<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\DoaController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\RoleController;
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
});


Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::resource('assignment',AssignmentController::class);
    Route::resource('wfassignment',WfassignmentController::class);
    Route::resource('timesheet',TimesheetController::class);
});

//approval URL
Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/assignment/{id}/applicant/approval',[ApplicantController::class, 'showApprovalPage']);
    Route::get('/assignment/{id}/timesheet/approval',[TimesheetController::class, 'showApprovalPage']);
    Route::post('/assignment/applicant/approval',[ApplicantController::class, 'storeApproval'])->name('applicant.approve');

    //Route::get('/assignment/{id}/asdasd/approval',[ApplicantController::class, 'showApprovalPage']);
    //Route::post('/assignment/asdasd/approval',[ApplicantController::class, 'storeApproval']);

});

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    //pada method resource('nama path nya','controller class'). pada parameter ke dua expect nya string bukan array.
    Route::resource('role', RoleController::class);
    Route::post('role/search', [RoleController::class, 'search'])->name('searchrole');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    //pada method resource('nama path nya','controller class'). pada parameter ke dua expect nya string bukan array.
    Route::resource('pegawai',PegawaiController::class);
    Route::resource('doa',DoaController::class);
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
