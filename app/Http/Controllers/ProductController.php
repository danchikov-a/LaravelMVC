<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Service;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Config;

class ProductController extends Controller
{
    private string $productWithServices;

    public function __construct()
    {
        $this->productWithServices = Config::get("sessionVariables.productWithServices");
    }

    public function index(): Factory|View|Application
    {
        $products = Product::all();

        return view("/products", ['products' => $products]);
    }

    public function show(Product $product): Factory|View|Application
    {
        session()->keep($this->productWithServices);

        $services = $this->changeServicesAccordingToClicked(session($this->productWithServices), Service::all());

        return view("/product", ['product' => $product, 'services' => $services]);
    }

    private function changeServicesAccordingToClicked(?array $clickedServices, Collection $services): Collection
    {
        if ($clickedServices != null) {
            foreach ($clickedServices as $clickedService) {
                foreach ($services as $service) {
                    if ($service->name == $clickedService->name) {
                        $service->isAdded = true;
                    }
                }
            }
        }

        return $services;
    }
}
