<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ServiceController extends Controller
{
    public function show(Service $service): Factory|View|Application
    {
        return view("/service", ['service' => $service]);
    }
}
