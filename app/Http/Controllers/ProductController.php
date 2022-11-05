<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view("/products", ['products' => $products]);
    }

    public function show(Product $product)
    {
        $services = Service::all();

        return view("/product", ['product' => $product, 'services' => $services]);
    }
}
