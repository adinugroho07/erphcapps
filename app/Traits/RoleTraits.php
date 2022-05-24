<?php

namespace App\Traits;

use App\Models\User;

trait RoleTraits
{
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
