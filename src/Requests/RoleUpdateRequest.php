<?php

namespace Koraycicekciogullari\HydroPermission\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class RoleUpdateRequest extends FormRequest
{

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return Auth::user()->can('role update') || Auth::user()->hasAnyRole(['root', 'admin']);
    }

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'name'  =>  ['required', Rule::unique('roles', 'name')->ignore($this->request->get('id'))]
        ];
    }
}
