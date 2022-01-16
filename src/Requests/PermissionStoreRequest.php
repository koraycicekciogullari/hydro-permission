<?php

namespace Koraycicekciogullari\HydroPermission\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PermissionStoreRequest extends FormRequest
{

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return Auth::user()->can('permission store') || Auth::user()->hasAnyRole(['root', 'admin']);
    }

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'name'  =>  ['required', Rule::unique('permissions', 'name')]
        ];
    }
}
