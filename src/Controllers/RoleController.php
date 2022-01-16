<?php

namespace Koraycicekciogullari\HydroPermission\Controllers;

use App\Http\Controllers\Controller;
use Koraycicekciogullari\HydroPermission\Requests\RoleCreateRequest;
use Koraycicekciogullari\HydroPermission\Requests\RoleUpdateRequest;
use Koraycicekciogullari\HydroPermission\Resources\RoleCollection;
use Koraycicekciogullari\HydroPermission\Resources\RoleResource;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('role_or_permission:admin|root|role index')->only(['index']);
        $this->middleware('role_or_permission:admin|root|role store')->only(['store']);
        $this->middleware('role_or_permission:admin|root|role show')->only(['show']);
        $this->middleware('role_or_permission:admin|root|role update')->only(['update']);
        $this->middleware('role_or_permission:admin|root|role destroy')->only(['destroy']);
    }

    /**
     * @return RoleCollection
     */
    public function index(): RoleCollection
    {
        return new RoleCollection(Role::all());
    }

    /**
     * @param RoleCreateRequest $request
     * @return RoleResource
     */
    public function store(RoleCreateRequest $request): RoleResource
    {
        return new RoleResource(Role::create($request->validated()));
    }

    /**
     * @param Role $role
     * @return RoleResource
     */
    public function show(Role $role): RoleResource
    {
        return new RoleResource($role);
    }

    /**
     * @param RoleUpdateRequest $request
     * @param Role $role
     * @return RoleResource
     */
    public function update(RoleUpdateRequest $request, Role $role): RoleResource
    {
        $role->update($request->only(['name']));
        return new RoleResource($role);
    }

    /**
     * @param Role $role
     */
    public function destroy(Role $role)
    {
        $role->delete();
    }
}
