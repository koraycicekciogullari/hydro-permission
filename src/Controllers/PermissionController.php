<?php

namespace Koraycicekciogullari\HydroPermission\Controllers;

use App\Http\Controllers\Controller;
use Koraycicekciogullari\HydroPermission\Requests\PermissionStoreRequest;
use Koraycicekciogullari\HydroPermission\Requests\PermissionUpdateRequest;
use Koraycicekciogullari\HydroPermission\Resources\PermissionCollection;
use Koraycicekciogullari\HydroPermission\Resources\PermissionResource;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('role_or_permission:admin|root|permission index')->only(['index']);
        $this->middleware('role_or_permission:admin|root|permission store')->only(['store']);
        $this->middleware('role_or_permission:admin|root|permission show')->only(['show']);
        $this->middleware('role_or_permission:admin|root|permission update')->only(['update']);
        $this->middleware('role_or_permission:admin|root|permission destroy')->only(['destroy']);
    }

    /**
     * @return PermissionCollection
     */
    public function index(): PermissionCollection
    {
        return new PermissionCollection(Permission::all());
    }

    /**
     * @param PermissionStoreRequest $request
     * @return PermissionResource
     */
    public function store(PermissionStoreRequest $request): PermissionResource
    {
        return new PermissionResource(Permission::create($request->validated()));
    }

    /**
     * @param Permission $permission
     * @return PermissionResource
     */
    public function show(Permission $permission): PermissionResource
    {
        return new PermissionResource($permission);
    }

    /**
     * @param PermissionUpdateRequest $request
     * @param Permission $permission
     * @return PermissionResource
     */
    public function update(PermissionUpdateRequest $request, Permission $permission): PermissionResource
    {
        $permission->update($request->validated());
        return new PermissionResource($permission);
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
    }
}
