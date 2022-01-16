<?php

use Koraycicekciogullari\HydroPermission\Controllers\AdminAssignPermission;
use Koraycicekciogullari\HydroPermission\Controllers\AdminAssignRole;
use Koraycicekciogullari\HydroPermission\Controllers\PermissionController;
use Koraycicekciogullari\HydroPermission\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'api'])->prefix('api/admin')->group(function(){
    Route::apiResource('roles', RoleController::class)->except('edit', 'create');
    Route::apiResource('permissions', PermissionController::class)->except('edit', 'create');
    Route::apiResource('assign-role', AdminAssignRole::class)->only('update');
    Route::apiResource('assign-permission', AdminAssignPermission::class)->only('update');
});
