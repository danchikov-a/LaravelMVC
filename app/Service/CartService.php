<?php

namespace App\Service;

use App\Models\Product;
use App\Models\Service;
use App\Traits\ConfigTrait;
use Illuminate\Database\Eloquent\Collection;

class CartService
{
    use ConfigTrait;

    private static int $totalCost = 0;
    /**
     * @return array
     */
    public static function getCart(): array
    {
        return session(config(self::$cartConfig)) ?? [];
    }

    public static function addToCart(Product $product): void
    {
        session()->push(config(self::$cartConfig), [$product->id => session(config(self::$productWithServicesConfig))]);
    }

    public static function getProductsWithServices(): array
    {
        $cart = self::getCart();
        $products = [];

        foreach ($cart as $productWithServices) {
            foreach ($productWithServices as $productId => $services) {
                $product = Product::where('id', $productId)->first();
                $product->services = $services;
                $product->totalCost = self::getTotalCostOfProduct($product, $services);
                self::$totalCost += $product->totalCost;

                $products[] = $product;
            }
        }

        return $products;
    }

    private static function getTotalCostOfProduct(Product $product, array $services): int
    {
        $totalCost = $product->cost;

        foreach ($services as $service) {
            $totalCost += $service->cost;
        }

        return $totalCost;
    }

    public static function getTotalCost(): int
    {
        return self::$totalCost;
    }

    public static function deleteServiceFromProduct(Service $service): array
    {
        $servicesFromProduct = session(config(self::$productWithServicesConfig));

        foreach ($servicesFromProduct as $index => $serviceFromProduct) {
            if ($serviceFromProduct->id == $service->id) {
                unset($servicesFromProduct[$index]);
            }
        }

        return $servicesFromProduct;
    }

    public static function addServiceToProduct(Service $service): array
    {
        return array_merge((array)session(config(self::$productWithServicesConfig)), [$service]);
    }

    public static function changeServicesAccordingToClicked(): Collection
    {
        $clickedServices = session(config(self::$productWithServicesConfig));
        $services = Service::all();

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

    public static function deleteFromCart(Product $product): void
    {
        $cart = self::getCart();

        foreach ($cart as $index => $productWithServices) {
            foreach ($productWithServices as $productId => $services) {
                if ($product->id == $productId) {
                    unset($cart[$index]);
                }
            }
        }

        session()->put(config(self::$cartConfig), $cart);
    }
}
