<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Service\CartService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Config;

class ProductController extends Controller
{
    private string $productWithServices;
    private CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->productWithServices = Config::get("sessionVariables.productWithServices");
        $this->cartService = $cartService;
    }

    public function index(): Factory|View|Application
    {
        $products = Product::all();

        return view("/products", ['products' => $products]);
    }

    public function show(Product $product): Factory|View|Application
    {
        session()->keep($this->productWithServices);

        $services = $this->cartService->changeServicesAccordingToClicked();

        return view("/product", ['product' => $product, 'services' => $services]);
    }
}
