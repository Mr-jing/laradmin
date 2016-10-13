<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SetRoleIdsRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'role_ids' => 'array',
        ];
    }

    public function messages()
    {
        return [
//            'role_ids.required' => trans('validation.role_ids.required'),
            'role_ids.array' => trans('validation.role_ids.array'),
        ];
    }
}
