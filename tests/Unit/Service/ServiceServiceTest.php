<?php

namespace Tests\Unit\Service;

use App\Models\Service;
use App\Service\ServiceManager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceServiceTest extends TestCase
{
    use RefreshDatabase;

    private const TEST_INPUT = [
        'name' => 'test',
        'deadline' => 30,
        'cost' => 50,
    ];

    public function test_service_service_properly_save_Service()
    {
        $service = new ServiceManager();

        $service->save(self::TEST_INPUT);

        self::assertNotNull(Service::where('name', 'test')->first());
    }

    public function test_service_service_properly_destroy_Service()
    {
        $service = new ServiceManager();

        $service->save(self::TEST_INPUT);

        $serviceId = Service::where('name', 'test')->first()->id;

        $service->destroy($serviceId);

        self::assertNull(Service::where('id', $serviceId)->first());
    }

    public function test_service_service_properly_update_Service()
    {
        $service = new ServiceManager();

        $service->save(self::TEST_INPUT);

        $serviceId = Service::where('name', 'test')->first()->id;

        $service->update($serviceId,
            [
                'name' => 'testtest',
                'deadline' => 30,
                'cost' => 50,
            ]
        );

        self::assertSame(Service::where('id', $serviceId)->first()->name, 'testtest');
    }

    public function test_service_service_properly_get_all()
    {
        $service = new ServiceManager();

        self::assertSame($service->getAll()->count(), 4);
    }
}
