<?php

namespace Tests\Unit;

use App\Providers\TokenValidatorServiceProvider;
use Illuminate\Support\Str;
use Tests\TestCase;

class TokenValidatorTest extends TestCase
{
    
    public function testImplementation(): void
    {
        $service = $this->getMockBuilder(TokenValidatorServiceProvider::class)
            ->onlyMethods(['validate'])
            ->disableOriginalConstructor()
            ->getMock();
        $in = Str::random(40);
        $service->expects($this->any())
            ->method('validate')
            ->with($in);
        $this->assertIsBool($service->validate($in));
    }    
    
    public function testInvalidTokens(): void
    {
        $service = new TokenValidatorServiceProvider($this->app);
        $tokens = [
            '{)',
            '[{]}',
            '(((((((()'
        ];
        foreach ($tokens as $token) {
            $this->assertFalse($service->validate($token));
        }
    }
    
    public function testValidTokens(): void
    {
        $service = new TokenValidatorServiceProvider($this->app);        
        $tokens = [
            '{}', 
            '{}[]()',
            '{([])}'
        ];        
        foreach ($tokens as $token) {
            $this->assertTrue($service->validate($token));
        }
    }
      
}

