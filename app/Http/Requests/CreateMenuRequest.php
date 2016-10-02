<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateMenuRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'menu_parent_id' => 'required|integer',
            'menu_name' => 'required|string|between:1,15',
            'menu_url' => 'string|between:0,255',
            'menu_sort' => 'integer',
        ];
    }

    public function messages()
    {
        return [
            'menu_parent_id.required' => trans('validation.menu_parent_id.required'),
            'menu_name.required' => trans('validation.menu_name.required'),
        ];
    }
}
