<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Service\ProductService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AdministrationProductController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        if ($request->validated()) {
            $input = $this->getFieldsFromForm($request);

            $this->productService->save($input);

            return redirect()->to("/products");
        } else {
            return redirect()->back();
        }
    }

    public function destroy(Product $product): RedirectResponse
    {
        $this->productService->destroy($product->id);

        return redirect()->back();
    }

    public function edit(Product $product): Factory|View|Application
    {
        return view("/productEdit", ['product' => $product]);
    }

    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $input = $this->getFieldsFromForm($request);

        $this->productService->update($product->id, $input);

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
