<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;

class ServiceControllerTest extends TestCase
{
    public function test_show_should_return_not_found_status_code_when_no_such_service()
    {
        $response = $this->get('/services/-1');

        $response->assertStatus(404);
    }
}
