<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SetMenuIdsRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'menu_ids' => 'array',
        ];
    }

    public function messages()
    {
        return [
            'menu_ids.array' => trans('validation.menu_ids.array'),
        ];
    }
}
