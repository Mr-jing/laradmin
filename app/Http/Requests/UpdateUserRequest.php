<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateUserRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = intval($this->route('users'));
        return [
            'name' => 'required|max:20|unique:users,name,' . $id,
            'email' => 'required|max:255|email|unique:users,email,' . $id,
            'password' => 'between:6,30|confirmed',
            'role_id' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('validation.fields.user.name.required'),
            'name.max' => trans('validation.fields.user.name.max'),
            'name.unique' => trans('validation.fields.user.name.unique'),
        ];
    }
}
