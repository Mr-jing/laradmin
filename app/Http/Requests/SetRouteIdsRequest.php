<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SetRouteIdsRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'route_ids' => 'array',
        ];
    }

    public function messages()
    {
        return [
            'route_ids.array' => trans('validation.route_ids.array'),
        ];
    }
}
