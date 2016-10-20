<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreUserRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = intval($this->route('roles'));
        return [
            'name' => 'required|max:20|unique:users,name,' . $id,
            'email' => 'required|max:255|email|unique:users,email,' . $id,
            'password' => 'required|between:6,30|confirmed',
            'role_id' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('validation.fields.user.name.required'),
            'name.max' => trans('validation.user.name.max'),
        ];
    }
}
