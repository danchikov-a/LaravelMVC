<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Service\CartService;
use App\Service\ProductService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Config;

class ProductController extends Controller
{
    private string $productWithServices;
    private CartService $cartService;
    private ProductService $productService;

    public function __construct(CartService $cartService, ProductService $productService)
    {
        $this->productWithServices = Config::get("sessionVariables.productWithServices");
        $this->cartService = $cartService;
        $this->productService = $productService;
    }

    public function index(): Factory|View|Application
    {
        $products = $this->productService->getAll();

        return view("/products", ['products' => $products]);
    }

    public function show(Product $product): Factory|View|Application
    {
        session()->keep($this->productWithServices);

        $services = $this->cartService->changeServicesAccordingToClicked();

        return view("/product", ['product' => $product, 'services' => $services]);
    }
}
