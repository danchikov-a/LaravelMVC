<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Config;

class CartController extends Controller
{
    private string $productWithServices;

    public function __construct()
    {
        $this->productWithServices = Config::get("sessionVariables.productWithServices");
    }

    public function addServiceToProduct(Service $service): RedirectResponse
    {
        session()->flash($this->productWithServices,
            array_merge((array) session($this->productWithServices), array($service)));

        return redirect()->back();
    }

    public function deleteServiceFromProduct(Service $service): RedirectResponse
    {
        $servicesFromProduct = session($this->productWithServices);

        foreach ($servicesFromProduct as $index => $serviceFromProduct)
        {
            if ($serviceFromProduct->id == $service->id) {
                unset($servicesFromProduct[$index]);
            }
        }

        session()->flash($this->productWithServices, $servicesFromProduct);

        return redirect()->back();
    }
}
