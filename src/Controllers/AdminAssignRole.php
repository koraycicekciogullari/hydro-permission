<?php

namespace Koraycicekciogullari\HydroPermission\Controllers;

use App\Http\Controllers\Controller;
use Koraycicekciogullari\HydroAdministrator\Resources\AdministratorResource;
use Koraycicekciogullari\HydroPermission\Requests\AdminAssignRoleUpdateRequest;
use Spatie\Permission\Models\Role;
use Koraycicekciogullari\HydroAdministrator\Models\User;

class AdminAssignRole extends Controller
{

    public function __construct()
    {
        $this->middleware('role_or_permission:admin|root|administrator update')->only(['update']);
    }

    /**
     * @param AdminAssignRoleUpdateRequest $request
     * @param $id
     * @return AdministratorResource
     */
    public function update(AdminAssignRoleUpdateRequest $request, $id): AdministratorResource
    {
        return new AdministratorResource(User::find($id)->syncRoles(
            Role::query()->whereIn('id', $request->get('roles'))->get()->pluck('name')
        ));
    }

}
