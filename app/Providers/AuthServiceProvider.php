<?php

namespace App\Providers;

use App\Models\Absen;
use App\Models\Assignment;
use App\Models\Cuti;
use App\Models\Doa;
use App\Models\Mutasi;
use App\Models\Resign;
use App\Models\Roleheader;
use App\Models\Team;
use App\Models\Timesheet;
use App\Models\User;
use App\Models\Wfassignment;
use App\Policies\AbsenPolicy;
use App\Policies\AssignmentPolicy;
use App\Policies\CutiPolicy;
use App\Policies\DoaPolicy;
use App\Policies\MutasiPolicy;
use App\Policies\PegawaiPolicy;
use App\Policies\ResignPolicy;
use App\Policies\RoleheaderPolicy;
use App\Policies\TeamPolicy;
use App\Policies\TimesheetPolicy;
use App\Policies\UserPolicy;
use App\Policies\WfassignmentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Team::class => TeamPolicy::class,
        User::class => UserPolicy::class,
        Timesheet::class => TimesheetPolicy::class,
        Cuti::class => CutiPolicy::class,
        Doa::class => DoaPolicy::class,
        Absen::class => AbsenPolicy::class,
        Mutasi::class => MutasiPolicy::class,
        Assignment::class => AssignmentPolicy::class,
        Roleheader::class => RoleheaderPolicy::class,
        Wfassignment::class => WfassignmentPolicy::class,
        Resign::class => ResignPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
