<?php

namespace App\Http\Requests;

use App\Models\Theme;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateThemeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('theme_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:themes,name,' . request()->route('theme')->id,
            ],
        ];
    }
}
