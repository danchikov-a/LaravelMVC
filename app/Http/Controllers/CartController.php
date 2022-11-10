<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Service;
use App\Service\CartService;
use App\Traits\ConfigTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CartController extends Controller
{
    use ConfigTrait;

    public function addServiceToProduct(Product $product, Service $service): RedirectResponse
    {
        $servicesFromProduct = CartService::addServiceToProduct($service);

        session()->flash(config(self::$productWithServicesConfig), $servicesFromProduct);

        return redirect()->to(route('productsShow', ['product' => $product->id]));
    }

    public function deleteServiceFromProduct(Product $product, Service $service): RedirectResponse
    {
        $servicesFromProduct = CartService::deleteServiceFromProduct($service);

        session()->flash(config(self::$productWithServicesConfig), $servicesFromProduct);

        return redirect()->to(route('productsShow', ['product' => $product->id]));
    }

    public function add(Product $product): RedirectResponse
    {
        CartService::addToCart($product);

        return redirect()->to(route('productsIndex'));
    }

    public function index(): Factory|View|Application
    {
        $products = CartService::getProductsWithServices();
        $totalCost = CartService::getTotalCost();

        return view('cart', ['products' => $products, 'totalCost' => $totalCost]);
    }

    public function destroy(Product $product): RedirectResponse
    {
        CartService::deleteFromCart($product);

        return redirect()->to(route('cartIndex'));
    }
}
