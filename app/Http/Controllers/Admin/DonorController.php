<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDonorRequest;
use App\Http\Requests\StoreDonorRequest;
use App\Http\Requests\UpdateDonorRequest;
use App\Models\Donor;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DonorController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('donor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $donors = Donor::all();

        return view('admin.donors.index', compact('donors'));
    }

    public function create()
    {
        abort_if(Gate::denies('donor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.donors.create');
    }

    public function store(StoreDonorRequest $request)
    {
        $donor = Donor::create($request->all());

        return redirect()->route('admin.donors.index');
    }

    public function edit(Donor $donor)
    {
        abort_if(Gate::denies('donor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.donors.edit', compact('donor'));
    }

    public function update(UpdateDonorRequest $request, Donor $donor)
    {
        $donor->update($request->all());

        return redirect()->route('admin.donors.index');
    }

    public function show(Donor $donor)
    {
        abort_if(Gate::denies('donor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $donor->load('donorsProjects');

        return view('admin.donors.show', compact('donor'));
    }

    public function destroy(Donor $donor)
    {
        abort_if(Gate::denies('donor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $donor->delete();

        return back();
    }

    public function massDestroy(MassDestroyDonorRequest $request)
    {
        Donor::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
