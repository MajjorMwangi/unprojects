@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.project.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.projects.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.project.fields.id') }}
                        </th>
                        <td>
                            {{ $project->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.project.fields.title') }}
                        </th>
                        <td>
                            {{ $project->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.project.fields.paas_code') }}
                        </th>
                        <td>
                            {{ $project->paas_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.project.fields.approval_status') }}
                        </th>
                        <td>
                            {{ App\Models\Project::APPROVAL_STATUS_SELECT[$project->approval_status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.project.fields.fund') }}
                        </th>
                        <td>
                            {{ $project->fund->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.project.fields.pag_value') }}
                        </th>
                        <td>
                            {{ $project->pag_value }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.project.fields.start_date') }}
                        </th>
                        <td>
                            {{ $project->start_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.project.fields.end_date') }}
                        </th>
                        <td>
                            {{ $project->end_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.project.fields.country') }}
                        </th>
                        <td>
                            @foreach($project->countries as $key => $country)
                                <span class="label label-info">{{ $country->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.project.fields.lead_organisation_unit') }}
                        </th>
                        <td>
                            {{ $project->lead_organisation_unit->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.project.fields.theme') }}
                        </th>
                        <td>
                            @foreach($project->themes as $key => $theme)
                                <span class="label label-info">{{ $theme->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.project.fields.donors') }}
                        </th>
                        <td>
                            @foreach($project->donors as $key => $donors)
                                <span class="label label-info">{{ $donors->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.project.fields.total_expenditure') }}
                        </th>
                        <td>
                            {{ $project->total_expenditure }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.project.fields.total_contribution') }}
                        </th>
                        <td>
                            {{ $project->total_contribution }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.project.fields.total_psc') }}
                        </th>
                        <td>
                            {{ $project->total_psc }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.projects.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection