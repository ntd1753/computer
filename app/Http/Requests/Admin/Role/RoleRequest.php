<?php

namespace App\Http\Requests\Admin\Role;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $roleId = $this->input('id');

        return [
            'code' => 'required|unique:roles,code,' . $roleId,
            'name' => 'required|unique:roles,name,' . $roleId,
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => __('validation.required'),
            'code.unique' => __('validation.unique'),
            'name.required' => __('validation.required'),
            'name.unique' => __('validation.unique'),
        ];
    }

    public function attributes(): array
    {
        return [
            'code' => __('label.code'),
            'name' => __('label.name'),
        ];
    }
}
