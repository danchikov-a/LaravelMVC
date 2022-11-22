<?php

namespace App\Service;

use App\Filters\ProductFilter;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public static function getAll(Request $request): Collection
    {
        return ProductFilter::filter(Product::class, $request);
    }

    public static function export(array $catalog): bool
    {
        return Storage::put("/catalog.csv", self::strPutCsv($catalog));
    }

    private static function strPutCsv($catalog)
    {
        $fp = fopen('php://temp', 'r+b');

        foreach ($catalog as $row) {
            fputcsv($fp, $row);
        }

        rewind($fp);
        $data = rtrim(stream_get_contents($fp), "\n");
        fclose($fp);

        return $data;
    }
}
