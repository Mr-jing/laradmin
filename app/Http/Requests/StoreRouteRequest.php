<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreRouteRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'route_name' => 'required|string|between:1,15',
            'route_method' => 'required|max:20|in:GET,POST,PUT,DELETE',
            'route_uri' => 'required|max:255',
            'route_group' => 'string|between:0,20',
        ];
    }

    public function messages()
    {
        return [
            'route_name.required' => trans('validation.menu_parent_id.required'),
            'route_method.required' => trans('validation.menu_name.required'),
        ];
    }
}
