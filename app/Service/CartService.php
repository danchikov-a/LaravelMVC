<?php

namespace App\Service;

use App\Models\Product;
use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Config;

class CartService
{
    private string $cartConfig;
    private string $productWithServices;
    private int $totalCost = 0;

    public function __construct()
    {
        $this->cartConfig = Config::get("sessionVariables.cart");
        $this->productWithServices = Config::get("sessionVariables.productWithServices");
    }

    /**
     * @return array
     */
    public function getCart(): array
    {
        return session($this->cartConfig) ?? [];
    }

    public function addToCart(Product $product): void
    {
        session()->push($this->cartConfig, [$product->id => session($this->productWithServices)]);
    }

    public function getProductsWithServices(): array
    {
        $cart = $this->getCart();
        $products = [];

        foreach ($cart as $productWithServices) {
            foreach ($productWithServices as $productId => $services) {
                $product = Product::where('id', $productId)->first();
                $product->services = $services;
                $product->totalCost = $this->getTotalCostOfProduct($product, $services);
                $this->totalCost += $product->totalCost;

                $products[] = $product;
            }
        }

        return $products;
    }

    private function getTotalCostOfProduct(Product $product, array $services): int
    {
        $totalCost = $product->cost;

        foreach ($services as $service) {
            $totalCost += $service->cost;
        }

        return $totalCost;
    }

    public function getTotalCost(): int
    {
        return $this->totalCost;
    }

    public function deleteServiceFromProduct(Service $service): array
    {
        $servicesFromProduct = session($this->productWithServices);

        foreach ($servicesFromProduct as $index => $serviceFromProduct)
        {
            if ($serviceFromProduct->id == $service->id) {
                unset($servicesFromProduct[$index]);
            }
        }

        return $servicesFromProduct;
    }

    public function addServiceToProduct(Service $service): array
    {
        return array_merge((array) session($this->productWithServices), array($service));
    }

    public function changeServicesAccordingToClicked(): Collection
    {
        $clickedServices = session($this->productWithServices);
        $services = Service::all();

        if ($clickedServices != null) {
            foreach ($clickedServices as $clickedService) {
                foreach ($services as $service) {
                    echo "here";
                    if ($service->name == $clickedService->name) {
                        echo "here@@";
                        $service->isAdded = true;
                    }
                }
            }
        }

        return $services;
    }

    public function deleteFromCart(Product $product): void
    {
        $cart = $this->getCart();

        foreach ($cart as $index => $productWithServices) {
            foreach ($productWithServices as $productId => $services) {
                if ($product->id == $productId) {
                    unset($cart[$index]);
                }
            }
        }

        session()->put($this->cartConfig, $cart);
    }
}
