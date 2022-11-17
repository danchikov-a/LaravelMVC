<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Service\ProductService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class AdministrationProductController extends Controller
{
    public function store(ProductRequest $request): RedirectResponse
    {
        if ($request->validated()) {
            ProductService::save($request->all());
        }

        return redirect()->to(route('productsIndex'));
    }

    public function destroy(Product $product): RedirectResponse
    {
        ProductService::destroy($product->id);

        return redirect()->to(route('productsIndex'));
    }

    public function edit(Product $product): Factory|View|Application
    {
        return view('/productEdit', ['product' => $product]);
    }

    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        ProductService::update($product->id, $request->all());

        return redirect()->to(route('productsIndex'));
    }

    public function export()
    {

        Storage::disk('s3')->put('q.txt', 'qwe');
    }
}
