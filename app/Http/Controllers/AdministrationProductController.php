<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;

class AdministrationProductController extends Controller
{
    public function store(ProductRequest $request)
    {
        if ($request->validated()) {
            $product = Product::create($this->getFieldsFromForm($request));

            $product->save();

            return redirect()->to("/products");
        } else {
            return redirect()->back();
        }
    }

    public function destroy(Product $product)
    {
        Product::destroy($product->id);

        return redirect()->back();
    }

    public function edit(Product $product)
    {
        return view("/productEdit", ['product' => $product]);
    }

    public function update(ProductRequest $request, Product $product)
    {
        Product::where('id', $product->id)->update($this->getFieldsFromForm($request));

        return redirect()->to('/products');
    }

    private function getFieldsFromForm(ProductRequest $request): array
    {
        return [
            'name' => $request->name,
            'manufacture' => $request->manufacture,
            'description' => $request->description,
            'releaseDate' => $request->releaseDate,
            'cost' => $request->cost
        ];
    }
}
