<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDonorRequest;
use App\Http\Requests\UpdateDonorRequest;
use App\Http\Resources\Admin\DonorResource;
use App\Models\Donor;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DonorApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('donor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DonorResource(Donor::all());
    }

    public function store(StoreDonorRequest $request)
    {
        $donor = Donor::create($request->all());

        return (new DonorResource($donor))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Donor $donor)
    {
        abort_if(Gate::denies('donor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DonorResource($donor);
    }

    public function update(UpdateDonorRequest $request, Donor $donor)
    {
        $donor->update($request->all());

        return (new DonorResource($donor))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Donor $donor)
    {
        abort_if(Gate::denies('donor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $donor->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
