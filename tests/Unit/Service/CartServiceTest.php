<?php

namespace Tests\Unit\Service;

use App\Models\Product;
use App\Models\Service;
use App\Service\CartService;
use App\Service\ServiceService;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class CartServiceTest extends TestCase
{
    private CartService $cartService;
    private string $cartConfig;
    private string $productWithServices;

    private const TEST_PRODUCT = [
        'id' => 0,
        'name' => 'test',
        'manufacture' => 'test',
        'description' => 'test',
        'releaseDate' => '1980-10-15',
        'cost' => 200
    ];

    private const TEST_SERVICE = [
        'id' => 0,
        'name' => 'test',
        'deadline' => 30,
        'cost' => 200
    ];

    public function setUp(): void
    {
        parent::setUp();
        session()->invalidate();
        $this->cartService = new CartService();
        $this->cartConfig = Config::get("sessionVariables.cart");
        $this->productWithServices = Config::get("sessionVariables.productWithServices");
    }

    public function test_get_cart_if_cart_empty()
    {
        self::assertNotNull($this->cartService->getCart());
    }

    public function test_add_to_cart()
    {
        $this->cartService->addToCart(Product::create(self::TEST_PRODUCT));
        $cart = session($this->cartConfig);

        self::assertSame(count($cart), 1);
    }

    public function test_delete_from_cart()
    {
        $product = Product::create(self::TEST_PRODUCT);

        $this->cartService->addToCart($product);
        $this->cartService->deleteFromCart($product);

        $cart = session($this->cartConfig);

        self::assertSame(count($cart), 0);
    }

    public function test_add_service_to_product()
    {
        $productWithServices = $this->cartService->addServiceToProduct(Service::create(self::TEST_SERVICE));

        self::assertSame(count($productWithServices), 1);
    }

    public function test_delete_service_from_products()
    {
        $service = Service::create(self::TEST_SERVICE);
        $productWithServices = $this->cartService->addServiceToProduct($service);
        session()->put($this->productWithServices, $productWithServices);
        $productWithServices = $this->cartService->deleteServiceFromProduct($service);

        self::assertSame(count($productWithServices), 0);
    }
}
