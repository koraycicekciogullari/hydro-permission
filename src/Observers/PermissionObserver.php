<?php

namespace Koraycicekciogullari\HydroPermission\Observers;

use Spatie\Permission\Models\Permission;
use User;

class PermissionObserver
{

    /**
     * @param Permission $permission
     */
    public function deleted(Permission $permission)
    {
        foreach (User::permission($permission)->get() as $user){
            $user->revokePermissionTo($user);
        }
    }
}
