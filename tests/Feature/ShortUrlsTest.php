<?php

namespace Tests\Feature;

use Tests\TestCase;

class ShortUrlsTest extends TestCase
{
    
    private const BASE_URL = '/api/v1/short-urls';

    public function testRouteExists(): void
    {
        $response = $this->post(self::BASE_URL);
        $response->assertOk();
    }

    public function testResponseIsJson(): void
    {
        $response = $this->post(self::BASE_URL);
        $response->assertJsonIsObject();
    }

}
