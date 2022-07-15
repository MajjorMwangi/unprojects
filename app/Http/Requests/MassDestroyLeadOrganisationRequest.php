<?php

namespace App\Http\Requests;

use App\Models\LeadOrganisation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyLeadOrganisationRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('lead_organisation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:lead_organisations,id',
        ];
    }
}
