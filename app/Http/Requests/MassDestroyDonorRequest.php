<?php

namespace App\Http\Requests;

use App\Models\Donor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDonorRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('donor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:donors,id',
        ];
    }
}
