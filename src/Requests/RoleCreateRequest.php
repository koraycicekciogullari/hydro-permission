<?php

namespace Koraycicekciogullari\HydroPermission\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class RoleCreateRequest extends FormRequest
{

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return Auth::user()->can('role store') || Auth::user()->hasAnyRole(['root', 'admin']);
    }

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'name'  =>  ['required', Rule::unique('roles', 'name')]
        ];
    }
}
