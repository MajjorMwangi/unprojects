<?php

namespace App\Http\Requests;

use App\Models\Fund;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFundRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('fund_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:funds,name,' . request()->route('fund')->id,
            ],
        ];
    }
}
