<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use App\Service\ServiceManager;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AdministrationServiceController extends Controller
{
    public function show(): Factory|View|Application
    {
        $services = ServiceManager::getAll();

        return view('/services', ['services' => $services]);
    }

    public function store(ServiceRequest $request): RedirectResponse
    {
        if ($request->validated()) {
            ServiceManager::save(request()->all());
        }

        return redirect()->to(route('servicesIndex'));
    }

    public function destroy(Service $service): RedirectResponse
    {
        ServiceManager::destroy($service->id);

        return redirect()->to(route('servicesIndex'));
    }

    public function edit(Service $service): Factory|View|Application
    {
        return view('/serviceEdit', ['service' => $service]);
    }

    public function update(ServiceRequest $request, Service $service): RedirectResponse
    {
        ServiceManager::update($service->id, $request->all());

        return redirect()->to(route('servicesIndex'));
    }
}
