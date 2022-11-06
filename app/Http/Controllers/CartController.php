<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Service;
use App\Service\CartService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Config;

class CartController extends Controller
{
    private string $productWithServices;
    private CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->productWithServices = Config::get("sessionVariables.productWithServices");
        $this->cartService = $cartService;
    }

    public function addServiceToProduct(Service $service): RedirectResponse
    {
        $servicesFromProduct = $this->cartService->addServiceToProduct($service);

        session()->flash($this->productWithServices, $servicesFromProduct);

        return redirect()->back();
    }

    public function deleteServiceFromProduct(Service $service): RedirectResponse
    {
        $servicesFromProduct = $this->cartService->deleteServiceFromProduct($service);

        session()->flash($this->productWithServices, $servicesFromProduct);

        return redirect()->back();
    }

    public function addToCart(Product $product): RedirectResponse
    {
        $this->cartService->addToCart($product);

        return redirect()->to("/products");
    }

    public function index(): Factory|View|Application
    {
        $products = $this->cartService->getProductsWithServices();
        $totalCost = $this->cartService->getTotalCost();

        return view("/cart", ['products' => $products, 'totalCost' => $totalCost]);
    }

    public function destroy(Product $product): RedirectResponse
    {
        $this->cartService->deleteFromCart($product);

        return redirect()->to("/cart");
    }
}
