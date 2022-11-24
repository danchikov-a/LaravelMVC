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
    private const ELEMENTS_AT_PAGE = 10;

    public function index(Request $request): Factory|View|Application
    {
        $products = ProductService::getProductsWithUsdCosts(
            ProductService::getAll($request),
            CurrencyService::getUsdPrice(self::LOCALE_CURRENCY)
        );

        $sortedProducts = SortManager::sort($products, $request)->paginate(self::ELEMENTS_AT_PAGE)->withQueryString();

        return view('/products', ['products' => $sortedProducts]);
    }

    public function show(Product $product): Factory|View|Application
    {
        session()->keep(config(self::$productWithServicesConfig));

        $services = CartService::changeServicesAccordingToClicked();

        return view('/product', ['product' => $product, 'services' => $services]);
    }
}
