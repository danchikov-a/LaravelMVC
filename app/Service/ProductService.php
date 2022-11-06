<?php

namespace App\Service;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    public function save(array $input): void
    {
        $product = Product::create($input);

        $product->save();
    }

    public function destroy(int $id): void
    {
        Product::destroy($id);
    }

    public function update(int $id, array $input): void
    {
        Product::where('id', $id)->update($input);
    }

    public function getAll(): Collection
    {
        return Product::all();
    }
}
