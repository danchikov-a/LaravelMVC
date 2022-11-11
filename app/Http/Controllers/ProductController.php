<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Service\CartService;
use App\Service\ProductService;
use App\Service\SortManager;
use App\Traits\ConfigTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ConfigTrait;

    public function index(Request $request): Factory|View|Application
    {
        $products = SortManager::sort(ProductService::getAll(), $request->sort);

        return view("/products", ['products' => $products]);
    }

    public function show(Product $product): Factory|View|Application
    {
        session()->keep(config(self::$productWithServicesConfig));

        $services = CartService::changeServicesAccordingToClicked();

        return view("/product", ['product' => $product, 'services' => $services]);
    }
}
