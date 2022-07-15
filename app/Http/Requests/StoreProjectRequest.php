<?php

namespace App\Http\Requests;

use App\Models\Project;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProjectRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('project_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
                'unique:projects',
            ],
            'paas_code' => [
                'string',
                'required',
                'unique:projects',
            ],
            'approval_status' => [
                'required',
            ],
            'fund_id' => [
                'required',
                'integer',
            ],
            'pag_value' => [
                'required',
            ],
            'start_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'end_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'countries.*' => [
                'integer',
            ],
            'countries' => [
                'required',
                'array',
            ],
            'lead_organisation_unit_id' => [
                'required',
                'integer',
            ],
            'themes.*' => [
                'integer',
            ],
            'themes' => [
                'required',
                'array',
            ],
            'donors.*' => [
                'integer',
            ],
            'donors' => [
                'required',
                'array',
            ],
            'total_expenditure' => [
                'required',
            ],
            'total_contribution' => [
                'required',
            ],
            'total_psc' => [
                'required',
            ],
        ];
    }
}
