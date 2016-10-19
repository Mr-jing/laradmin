<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreRoleRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = intval($this->route('roles'));
        return [
            'role_name' => 'required|string|between:1,20|unique:roles,name,' . $id,
            'role_description' => 'string|between:0,255',
        ];
    }

    public function messages()
    {
        return [
            'role_name.required' => trans('validation.role_name.required'),
        ];
    }
}
