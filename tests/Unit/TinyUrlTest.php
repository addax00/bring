<?php

namespace Tests\Unit;

use App\Providers\TinyUrlServiceProvider;
use Illuminate\Support\Str;
use Tests\TestCase;

class TinyUrlTest extends TestCase
{
    
    public function testTinyUrlBasicImplementation(): void
    {
        $sourceUrl = 'https://' . Str::random(40);
        $service = $this->getMockBuilder(TinyUrlServiceProvider::class)
            ->onlyMethods(['getUrl'])
            ->disableOriginalConstructor()
            ->getMock();
        $service->expects($this->any())
            ->method('getUrl')
            ->with($sourceUrl);
        $destinationUrl = $service->getUrl($sourceUrl);
        $this->assertIsString($destinationUrl);
    }
    
    public function testTinyUrlResponseFormat(): void
    {
        $sourceUrl = 'https://' . Str::random(40);
        $service = new TinyUrlServiceProvider($this->app);
        $destinationUrl = $service->getUrl($sourceUrl);
        $this->assertMatchesRegularExpression('/https:\/\/tinyurl\.com\/.*/', $destinationUrl);
    }
      
}
