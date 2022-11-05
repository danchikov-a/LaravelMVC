<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AdministrationProductController extends Controller
{
    public function store(ProductRequest $request): RedirectResponse
    {
        if ($request->validated()) {
            $product = Product::create($this->getFieldsFromForm($request));

            $product->save();

            return redirect()->to("/products");
        } else {
            return redirect()->back();
        }
    }

    public function destroy(Product $product): RedirectResponse
    {
        Product::destroy($product->id);

        return redirect()->back();
    }

    public function edit(Product $product): Factory|View|Application
    {
        return view("/productEdit", ['product' => $product]);
    }

    public function update(ProductRequest $request, Product $product): RedirectResponse
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
