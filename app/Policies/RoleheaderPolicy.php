<?php

namespace App\Policies;

use App\Models\Roleheader;
use App\Models\User;
use App\Traits\RoleTraits;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class RoleheaderPolicy
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
        $isTrue = $this->checkRole($user, 'admin');
        if ($isTrue){
            return Response::allow();
        } else {
            return Response::deny('Only Admin Can Access This Page');
        };
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Roleheader  $roleheader
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Roleheader $roleheader)
    {
        $isTrue = $this->checkRole($user, 'admin');
        if ($isTrue){
            return Response::allow();
        } else {
            return Response::deny('Only Admin Can Access This Page');
        };
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        $isTrue = $this->checkRole($user, 'admin');
        if ($isTrue){
            return Response::allow();
        } else {
            return Response::deny('Only Admin Can Access This Page');
        };
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Roleheader  $roleheader
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Roleheader $roleheader)
    {
        $isTrue = $this->checkRole($user, 'admin');
        if ($isTrue){
            return Response::allow();
        } else {
            return Response::deny('Only Admin Can Access This Page');
        };
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Roleheader  $roleheader
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Roleheader $roleheader)
    {
        $isTrue = $this->checkRole($user, 'admin');
        if ($isTrue){
            return Response::allow();
        } else {
            return Response::deny('Only Admin Can Access This Page');
        };
    }

}
