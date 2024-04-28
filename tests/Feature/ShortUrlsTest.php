<?php

namespace Tests\Feature;

use Illuminate\Support\Str;
use Tests\TestCase;

class ShortUrlsTest extends TestCase
{
    
    private const BASE_URL = '/api/v1/short-urls';

    public function testRouteExistsMissingUrl(): void
    {
        $response = $this->post(self::BASE_URL, [], [
            'Authorization: Bearer'
        ]);
        $response->assertBadRequest();
    }

    public function testRouteExistsMissingToken(): void
    {
        $response = $this->post(self::BASE_URL, [
            'url' => 'https://' . Str::random(40)
        ]);
        $response->assertBadRequest();
    }

    public function testRouteExistsInvalidToken(): void
    {
        $response = $this->post(self::BASE_URL, [
            'url' => 'https://' . Str::random(40)
        ], [
            'Authorization: Bearer ({)}'
        ]);
        $response->assertBadRequest();
    }

    public function testRouteExistsValidData(): void
    {
        $response = $this->post(self::BASE_URL, [
            'url' => 'https://' . Str::random(40)
        ], [
            'Authorization: Bearer {}[]()'
        ]);
        $response->assertOk();
    }

    public function testResponseIsJson(): void
    {
        $response = $this->post(self::BASE_URL);
        $response->assertJsonIsObject();
    }

}
