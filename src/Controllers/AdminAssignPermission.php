<?php

namespace Koraycicekciogullari\HydroPermission\Controllers;

use App\Http\Controllers\Controller;
use Koraycicekciogullari\HydroPermission\Requests\AdminAssignPermissionUpdateRequest;
use Koraycicekciogullari\HydroPermission\Resources\PermissionResource;
use Spatie\Permission\Models\Permission;
use Koraycicekciogullari\HydroAdministrator\Models\User;

class AdminAssignPermission extends Controller
{

    public function __construct()
    {
        $this->middleware('role_or_permission:admin|root|administrator update')->only(['update']);
    }

    /**
     * @param AdminAssignPermissionUpdateRequest $request
     * @param $id
     * @return PermissionResource
     */
    public function update(AdminAssignPermissionUpdateRequest $request, $id): PermissionResource
    {
        return new PermissionResource([
            'user'  =>  $user = User::find($id)->syncPermissions(
                Permission::query()->whereIn('id', $request->get('permissions'))->get()->pluck('name')
            ),
            'permissions' => $user->permissions()->pluck('name')
        ]);
    }

}
