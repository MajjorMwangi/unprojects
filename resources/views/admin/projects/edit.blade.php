@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.project.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.projects.update", [$project->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.project.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $project->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="paas_code">{{ trans('cruds.project.fields.paas_code') }}</label>
                <input class="form-control {{ $errors->has('paas_code') ? 'is-invalid' : '' }}" type="text" name="paas_code" id="paas_code" value="{{ old('paas_code', $project->paas_code) }}" required>
                @if($errors->has('paas_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('paas_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.paas_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.project.fields.approval_status') }}</label>
                <select class="form-control {{ $errors->has('approval_status') ? 'is-invalid' : '' }}" name="approval_status" id="approval_status" required>
                    <option value disabled {{ old('approval_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Project::APPROVAL_STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('approval_status', $project->approval_status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('approval_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('approval_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.approval_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="fund_id">{{ trans('cruds.project.fields.fund') }}</label>
                <select class="form-control select2 {{ $errors->has('fund') ? 'is-invalid' : '' }}" name="fund_id" id="fund_id" required>
                    @foreach($funds as $id => $entry)
                        <option value="{{ $id }}" {{ (old('fund_id') ? old('fund_id') : $project->fund->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('fund'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fund') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.fund_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="pag_value">{{ trans('cruds.project.fields.pag_value') }}</label>
                <input class="form-control {{ $errors->has('pag_value') ? 'is-invalid' : '' }}" type="number" name="pag_value" id="pag_value" value="{{ old('pag_value', $project->pag_value) }}" step="0.01" required>
                @if($errors->has('pag_value'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pag_value') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.pag_value_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="start_date">{{ trans('cruds.project.fields.start_date') }}</label>
                <input class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="text" name="start_date" id="start_date" value="{{ old('start_date', $project->start_date) }}" required>
                @if($errors->has('start_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.start_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="end_date">{{ trans('cruds.project.fields.end_date') }}</label>
                <input class="form-control date {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="text" name="end_date" id="end_date" value="{{ old('end_date', $project->end_date) }}" required>
                @if($errors->has('end_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('end_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.end_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="countries">{{ trans('cruds.project.fields.country') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('countries') ? 'is-invalid' : '' }}" name="countries[]" id="countries" multiple required>
                    @foreach($countries as $id => $country)
                        <option value="{{ $id }}" {{ (in_array($id, old('countries', [])) || $project->countries->contains($id)) ? 'selected' : '' }}>{{ $country }}</option>
                    @endforeach
                </select>
                @if($errors->has('countries'))
                    <div class="invalid-feedback">
                        {{ $errors->first('countries') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.country_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="lead_organisation_unit_id">{{ trans('cruds.project.fields.lead_organisation_unit') }}</label>
                <select class="form-control select2 {{ $errors->has('lead_organisation_unit') ? 'is-invalid' : '' }}" name="lead_organisation_unit_id" id="lead_organisation_unit_id" required>
                    @foreach($lead_organisation_units as $id => $entry)
                        <option value="{{ $id }}" {{ (old('lead_organisation_unit_id') ? old('lead_organisation_unit_id') : $project->lead_organisation_unit->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('lead_organisation_unit'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lead_organisation_unit') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.lead_organisation_unit_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="themes">{{ trans('cruds.project.fields.theme') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('themes') ? 'is-invalid' : '' }}" name="themes[]" id="themes" multiple required>
                    @foreach($themes as $id => $theme)
                        <option value="{{ $id }}" {{ (in_array($id, old('themes', [])) || $project->themes->contains($id)) ? 'selected' : '' }}>{{ $theme }}</option>
                    @endforeach
                </select>
                @if($errors->has('themes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('themes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.theme_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="donors">{{ trans('cruds.project.fields.donors') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('donors') ? 'is-invalid' : '' }}" name="donors[]" id="donors" multiple required>
                    @foreach($donors as $id => $donor)
                        <option value="{{ $id }}" {{ (in_array($id, old('donors', [])) || $project->donors->contains($id)) ? 'selected' : '' }}>{{ $donor }}</option>
                    @endforeach
                </select>
                @if($errors->has('donors'))
                    <div class="invalid-feedback">
                        {{ $errors->first('donors') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.donors_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="total_expenditure">{{ trans('cruds.project.fields.total_expenditure') }}</label>
                <input class="form-control {{ $errors->has('total_expenditure') ? 'is-invalid' : '' }}" type="number" name="total_expenditure" id="total_expenditure" value="{{ old('total_expenditure', $project->total_expenditure) }}" step="0.01" required>
                @if($errors->has('total_expenditure'))
                    <div class="invalid-feedback">
                        {{ $errors->first('total_expenditure') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.total_expenditure_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="total_contribution">{{ trans('cruds.project.fields.total_contribution') }}</label>
                <input class="form-control {{ $errors->has('total_contribution') ? 'is-invalid' : '' }}" type="number" name="total_contribution" id="total_contribution" value="{{ old('total_contribution', $project->total_contribution) }}" step="0.01" required>
                @if($errors->has('total_contribution'))
                    <div class="invalid-feedback">
                        {{ $errors->first('total_contribution') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.total_contribution_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="total_psc">{{ trans('cruds.project.fields.total_psc') }}</label>
                <input class="form-control {{ $errors->has('total_psc') ? 'is-invalid' : '' }}" type="number" name="total_psc" id="total_psc" value="{{ old('total_psc', $project->total_psc) }}" step="0.01" required>
                @if($errors->has('total_psc'))
                    <div class="invalid-feedback">
                        {{ $errors->first('total_psc') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.total_psc_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection