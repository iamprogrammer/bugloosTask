<?php

namespace tests\Feature;

use Tests\TestCase;
use Throwable;

class LogsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     * @throws Throwable
     */
    public function testCountWithFilterParams()
    : void
    {
        $response = $this->call('GET', "/api/logs/count", ["statusCode" => 201]);

        $response->assertSee("count" );
    }

    /**
     * A basic test example.
     *
     * @return void
     * @throws Throwable
     */
    public function testCountWithoutParams()
    : void
    {
        $response = $this->get("/api/logs/count")->decodeResponseJson();
        $this->assertArrayHasKey("count", $response);
    }
}
