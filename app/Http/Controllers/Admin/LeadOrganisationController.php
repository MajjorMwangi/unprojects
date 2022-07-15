<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLeadOrganisationRequest;
use App\Http\Requests\StoreLeadOrganisationRequest;
use App\Http\Requests\UpdateLeadOrganisationRequest;
use App\Models\LeadOrganisation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LeadOrganisationController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('lead_organisation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $leadOrganisations = LeadOrganisation::all();

        return view('admin.leadOrganisations.index', compact('leadOrganisations'));
    }

    public function create()
    {
        abort_if(Gate::denies('lead_organisation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.leadOrganisations.create');
    }

    public function store(StoreLeadOrganisationRequest $request)
    {
        $leadOrganisation = LeadOrganisation::create($request->all());

        return redirect()->route('admin.lead-organisations.index');
    }

    public function edit(LeadOrganisation $leadOrganisation)
    {
        abort_if(Gate::denies('lead_organisation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.leadOrganisations.edit', compact('leadOrganisation'));
    }

    public function update(UpdateLeadOrganisationRequest $request, LeadOrganisation $leadOrganisation)
    {
        $leadOrganisation->update($request->all());

        return redirect()->route('admin.lead-organisations.index');
    }

    public function show(LeadOrganisation $leadOrganisation)
    {
        abort_if(Gate::denies('lead_organisation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $leadOrganisation->load('leadOrganisationUnitProjects');

        return view('admin.leadOrganisations.show', compact('leadOrganisation'));
    }

    public function destroy(LeadOrganisation $leadOrganisation)
    {
        abort_if(Gate::denies('lead_organisation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $leadOrganisation->delete();

        return back();
    }

    public function massDestroy(MassDestroyLeadOrganisationRequest $request)
    {
        LeadOrganisation::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
