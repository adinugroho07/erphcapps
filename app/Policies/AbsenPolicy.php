<?php

namespace App\Policies;

use App\Models\Absen;
use App\Models\User;
use App\Traits\RoleTraits;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AbsenPolicy
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
        return Response::allow();
    }

    public function DataAbsenAll(User $user){
        if($this->checkRole($user,'manager')){
            return Response::allow();
        }

        if($this->checkRole($user,'admin')){
            return Response::allow();
        }

        return Response::deny('You Not Authorize To Do This Action. Only Employees Who Have A Role Admin Or Role Manager Can Do This Action !!');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Absen  $absen
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Absen $absen)
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
     * @param  \App\Models\Absen  $absen
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Absen $absen)
    {
        return Response::allow();
    }

}
