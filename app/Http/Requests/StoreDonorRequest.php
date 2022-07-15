<?php

namespace App\Http\Requests;

use App\Models\Donor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDonorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('donor_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:donors',
            ],
        ];
    }
}
