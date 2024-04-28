<?php

namespace Tests\Feature;

use Illuminate\Support\Str;
use Tests\TestCase;

class ShortUrlsTest extends TestCase
{
    
    private const BASE_URL = '/api/v1/short-urls';

    public function testMissingUrl(): void
    {
        $response = $this->post(self::BASE_URL, [], [
            'Authorization' => 'Bearer'
        ]);
        $response->assertBadRequest();
        $response->assertJsonIsObject();        
    }

    public function testMissingToken(): void
    {
        $response = $this->post(self::BASE_URL, [
            'url' => 'https://' . Str::random(40)
        ]);
        $response->assertBadRequest();
        $response->assertJsonIsObject();        
    }

    public function testInvalidToken(): void
    {
        $response = $this->post(self::BASE_URL, [
            'url' => 'https://' . Str::random(40)
        ], [
            'Authorization' => 'Bearer ({)}'
        ]);
        $response->assertBadRequest();
        $response->assertJsonIsObject();        
    }

    public function testValidData(): void
    {
        $response = $this->post(self::BASE_URL, [
            'url' => 'https://' . Str::random(40)
        ], [
            'Authorization' => 'Bearer {}[]()'
        ]);
        $response->assertOk();
        $response->assertJsonIsObject();        
    }

}
