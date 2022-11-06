<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use App\Service\ServiceService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AdministrationServiceController extends Controller
{
    private ServiceService $serviceService;

    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    public function show(): Factory|View|Application
    {
        $services = $this->serviceService->getAll();

        return view("/services", ['services' => $services]);
    }

    public function store(ServiceRequest $request): RedirectResponse
    {
        if ($request->validated()) {
            $input = $this->getFieldsFromForm($request);

            $this->serviceService->save($input);

            return redirect()->to("/services");
        } else {
            return redirect()->back();
        }
    }

    public function destroy(Service $service): RedirectResponse
    {
        $this->serviceService->destroy($service->id);

        return redirect()->back();
    }

    public function edit(Service $service): Factory|View|Application
    {
        return view("/serviceEdit", ['service' => $service]);
    }

    public function update(ServiceRequest $request, Service $service): RedirectResponse
    {
        $input = $this->getFieldsFromForm($request);

        $this->serviceService->update($service->id, $input);

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
