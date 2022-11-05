<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AdministrationServiceController extends Controller
{
    public function show(): Factory|View|Application
    {
        $services = Service::all();

        return view("/services", ['services' => $services]);
    }

    public function store(ServiceRequest $request): RedirectResponse
    {
        if ($request->validated()) {
            $service = Service::create($this->getFieldsFromForm($request));

            $service->save();

            return redirect()->to("/services");
        } else {
            return redirect()->back();
        }
    }

    public function destroy(Service $service): RedirectResponse
    {
        Service::destroy($service->id);

        return redirect()->back();
    }

    public function edit(Service $service): Factory|View|Application
    {
        return view("/serviceEdit", ['service' => $service]);
    }

    public function update(ServiceRequest $request, Service $service): RedirectResponse
    {
        Service::where('id', $service->id)->update($this->getFieldsFromForm($request));

        return redirect()->to('/services');
    }

    private function getFieldsFromForm(ServiceRequest $request): array
    {
        return [
            'name' => $request->name,
            'deadline' => $request->deadline,
            'cost' => $request->cost,
        ];
    }
}
