<?php

namespace App\Policies;

use App\Models\Timesheet;
use App\Models\User;
use App\Traits\RoleTraits;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class TimesheetPolicy
{
    use HandlesAuthorization;
    use RoleTraits;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //untuk get data timesheet by id
        //defautl semua bisa access
        return Response::allow();
    }

    public function viewAll(User $user){
        if($this->checkRole($user,'manager')){
            return Response::allow();
        }

        if($this->checkRole($user,'admin')){
            return Response::allow();
        }

        return Response::deny('You Not Authorize To Access This Page !!');

    }

    public function approveShow(User $user){
        if($this->checkRole($user,'manager')){
            return Response::allow();
        }

        return Response::deny('You Not Authorize To Access This Page. Only Employees Who Have A Role Manager Can Access This Page !!');
    }

    public function approveStore(User $user){
        if($this->checkRole($user,'manager')){
            return Response::allow();
        }

        return Response::deny('You Not Authorize To Do This Action. Only Employees Who Have A Role Manager Can Do This Action !!');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Timesheet  $timesheet
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Timesheet $timesheet)
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Timesheet  $timesheet
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Timesheet $timesheet)
    {
        return Response::allow();
    }



}
