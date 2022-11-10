<?php

namespace Tests\Unit\Controllers;

use App\Http\Requests\ProductRequest;
use App\Service\ProductService;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class AdministrationProductControllerTest extends TestCase
{
    public function test_if_save_method_was_called_when_valid_request()
    {
        $productRequest = new ProductRequest();

        $this->instance(
            ProductRequest::class,
            Mockery::mock($productRequest, function (MockInterface $mock) {
                $mock->shouldReceive('validated')->andReturn(true);
            })
        );

        $this->instance(
            ProductService::class,
            Mockery::mock(ProductService::class, function (MockInterface $mock) {
                $mock->shouldReceive('save');
            })
        );

        $response = $this->post("/products");

        $response->assertStatus(302);
    }
}
