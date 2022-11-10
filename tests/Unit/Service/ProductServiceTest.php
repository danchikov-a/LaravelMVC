<?php

namespace Tests\Unit\Service;

use App\Models\Product;
use App\Service\ProductService;
use Tests\TestCase;

class ProductServiceTest extends TestCase
{
    private const TEST_INPUT = [
        'name' => 'test',
        'manufacture' => 'test',
        'description' => 'test',
        'releaseDate' => '1980-10-15',
        'cost' => 200
    ];

    public function test_product_service_properly_save_product()
    {
        ProductService::save(self::TEST_INPUT);

        self::assertNotNull(Product::where('name', 'test')->first());
    }

    public function test_product_service_properly_destroy_product()
    {
        ProductService::save(self::TEST_INPUT);

        $productId = Product::where('name', 'test')->first()->id;

        ProductService::destroy($productId);

        self::assertNull(Product::where('id', $productId)->first());
    }

    public function test_product_service_properly_update_product()
    {
        $service = new ProductService();

        ProductService::save(self::TEST_INPUT);

        $productId = Product::where('name', 'test')->first()->id;

        ProductService::update($productId,
            [
                'name' => 'testtest',
                'manufacture' => 'test',
                'description' => 'test',
                'releaseDate' => '1980-10-15',
                'cost' => 200
            ]
        );

        self::assertSame(Product::where('id', $productId)->first()->name, 'testtest');
    }
}
