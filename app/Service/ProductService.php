<?php

namespace App\Service;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    public static function save(array $input): void
    {
        $product = Product::create($input);

        $product->save();
    }

    public static function destroy(int $id): void
    {
        Product::destroy($id);
    }

    public static function update(int $id, array $input): void
    {
        Product::where('id', $id)->update($input);
    }

    public static function getAll(): Collection
    {
        return Product::all();
    }
}
