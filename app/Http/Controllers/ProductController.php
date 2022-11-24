<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Service\CartService;
use App\Service\CurrencyService;
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

    private const LOCALE_CURRENCY = 'BYN';

    public function index(Request $request): Factory|View|Application
    {
        $products = ProductService::getProductsWithUsdCosts(
            ProductService::getAll($request),
            CurrencyService::getUsdPrice(self::LOCALE_CURRENCY)
        );

        $sortedProducts = SortManager::sort($products, $request)->paginate(10)->withQueryString();

        return view('/products', ['products' => $sortedProducts]);
    }

    public function show(Product $product): Factory|View|Application
    {
        session()->keep(config(self::$productWithServicesConfig));

        $services = CartService::changeServicesAccordingToClicked();

        return view('/product', ['product' => $product, 'services' => $services]);
    }
}
