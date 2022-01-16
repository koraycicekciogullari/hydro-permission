<?php

namespace Koraycicekciogullari\HydroPermission\Observers;

use Spatie\Permission\Models\Role;
use User;

class RoleObserver
{

    /**
     * @param Role $role
     */
    public function deleted(Role $role)
    {
        foreach (User::role($role)->get() as $user){
            $user->removeRole($role);
        }
    }

}
