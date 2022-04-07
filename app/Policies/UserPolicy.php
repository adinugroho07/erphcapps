<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    use HandlesAuthorization;

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
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, User $model)
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
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, User $model)
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
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, User $model)
    {
        $isTrue = $this->checkRole($user, 'admin');
        if ($isTrue){
            return Response::allow();
        } else {
            return Response::deny('Only Admin Can Access This Page');
        };
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, User $model)
    {
        $isTrue = $this->checkRole($user, 'admin');
        if ($isTrue){
            return Response::allow();
        } else {
            return Response::deny('Only Admin Can Access This Page');
        };
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, User $model)
    {
        $isTrue = $this->checkRole($user, 'admin');
        if ($isTrue){
            return Response::allow();
        } else {
            return Response::deny('Only Admin Can Access This Page');
        };
    }

    public function checkRole(User $user,$rolename){
        $isTrue = false;
        $roles = $user->role()->get();
        foreach ($roles as $role){
            if ($role->rolename == $rolename){
                $isTrue = true;
            }
        };
        return $isTrue;
    }
}
