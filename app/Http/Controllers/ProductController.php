<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view("/products", ['products' => $products]);
    }

    public function show(int $id)
    {
        $product = Product::where('id', $id)->first();

        return view("/product", ['product' => $product]);
    }
}
