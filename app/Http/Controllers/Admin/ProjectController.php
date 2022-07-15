<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProjectRequest;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Country;
use App\Models\Donor;
use App\Models\Fund;
use App\Models\LeadOrganisation;
use App\Models\Project;
use App\Models\Theme;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProjectController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('project_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $projects = Project::with(['fund', 'countries', 'lead_organisation_unit', 'themes', 'donors'])->get();

        $funds = Fund::get();

        $countries = Country::get();

        $lead_organisations = LeadOrganisation::get();

        $themes = Theme::get();

        $donors = Donor::get();

        return view('admin.projects.index', compact('countries', 'donors', 'funds', 'lead_organisations', 'projects', 'themes'));
    }

    public function create()
    {
        abort_if(Gate::denies('project_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $funds = Fund::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $countries = Country::pluck('name', 'id');

        $lead_organisation_units = LeadOrganisation::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $themes = Theme::pluck('name', 'id');

        $donors = Donor::pluck('name', 'id');

        return view('admin.projects.create', compact('countries', 'donors', 'funds', 'lead_organisation_units', 'themes'));
    }

    public function store(StoreProjectRequest $request)
    {
        $project = Project::create($request->all());
        $project->countries()->sync($request->input('countries', []));
        $project->themes()->sync($request->input('themes', []));
        $project->donors()->sync($request->input('donors', []));

        return redirect()->route('admin.projects.index');
    }

    public function edit(Project $project)
    {
        abort_if(Gate::denies('project_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $funds = Fund::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $countries = Country::pluck('name', 'id');

        $lead_organisation_units = LeadOrganisation::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $themes = Theme::pluck('name', 'id');

        $donors = Donor::pluck('name', 'id');

        $project->load('fund', 'countries', 'lead_organisation_unit', 'themes', 'donors');

        return view('admin.projects.edit', compact('countries', 'donors', 'funds', 'lead_organisation_units', 'project', 'themes'));
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        $project->update($request->all());
        $project->countries()->sync($request->input('countries', []));
        $project->themes()->sync($request->input('themes', []));
        $project->donors()->sync($request->input('donors', []));

        return redirect()->route('admin.projects.index');
    }

    public function show(Project $project)
    {
        abort_if(Gate::denies('project_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $project->load('fund', 'countries', 'lead_organisation_unit', 'themes', 'donors');

        return view('admin.projects.show', compact('project'));
    }

    public function destroy(Project $project)
    {
        abort_if(Gate::denies('project_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $project->delete();

        return back();
    }

    public function massDestroy(MassDestroyProjectRequest $request)
    {
        Project::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
