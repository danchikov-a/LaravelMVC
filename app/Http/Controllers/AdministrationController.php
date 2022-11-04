<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;

class AdministrationController extends Controller
{
    public function store(ProductRequest $request)
    {
        if ($request->validated()) {
            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'manufacture' => $request->manufacture,
                'releaseDate' => $request->releaseDate,
                'cost' => $request->cost,
            ]);

            $product->save();

            return redirect()->to("/products");
        } else {
            return redirect()->back();
        }
    }
}
