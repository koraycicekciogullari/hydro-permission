<?php

namespace Koraycicekciogullari\HydroPermission\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AdminAssignPermissionUpdateRequest extends FormRequest
{

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return Auth::user()->can('permission update') || Auth::user()->hasAnyRole(['root', 'admin']);
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'permissions' => ['array']
        ];
    }
}
