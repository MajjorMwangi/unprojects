@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.leadOrganisation.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.lead-organisations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.leadOrganisation.fields.id') }}
                        </th>
                        <td>
                            {{ $leadOrganisation->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.leadOrganisation.fields.name') }}
                        </th>
                        <td>
                            {{ $leadOrganisation->name }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.lead-organisations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#lead_organisation_unit_projects" role="tab" data-toggle="tab">
                {{ trans('cruds.project.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="lead_organisation_unit_projects">
            @includeIf('admin.leadOrganisations.relationships.leadOrganisationUnitProjects', ['projects' => $leadOrganisation->leadOrganisationUnitProjects])
        </div>
    </div>
</div>

@endsection