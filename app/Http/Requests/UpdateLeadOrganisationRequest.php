<?php

namespace App\Http\Requests;

use App\Models\LeadOrganisation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateLeadOrganisationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('lead_organisation_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:lead_organisations,name,' . request()->route('lead_organisation')->id,
            ],
        ];
    }
}
