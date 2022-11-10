<?php

namespace Tests\Unit\Controllers;

use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Service\CartService;
use App\Service\ProductService;

use Illuminate\Database\Eloquent\Collection;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    public function test_index_should_return_success_status_code_when_no_products()
    {
        $response = $this->get('/products');

        $response->assertStatus(200);
    }

    public function test_show_should_return_not_found_status_code_when_no_such_product()
    {
        $response = $this->get('/products/-1');

        $response->assertStatus(404);
    }
}
