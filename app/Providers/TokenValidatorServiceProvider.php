<?php

namespace App\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class TokenValidatorServiceProvider extends ServiceProvider
{
    
    private const BRACKET_SET = [
        '(' => ')', '[' => ']', '{' => '}'
    ];

    public function __construct(Application $app) {
        parent::__construct($app);
    }

    public function register(): void {
        $this->app->singleton(TokenValidatorServiceProvider::class);
    }

    public function boot(): void {
        
    }
    
    public function validate(?string $in): bool
    {
        if (is_null($in)) {
            return false;
        }
        $bracketStack = [];
        $length = strlen($in);
        for ($i = 0; $i < $length; $i++) {
            if (array_key_exists($in[$i], self::BRACKET_SET)) {
                $bracketStack[] = self::BRACKET_SET[$in[$i]];
            } else if (array_pop($bracketStack) !== $in[$i]) {
                return false;
            }
        }

        return count($bracketStack) === 0;
    }
    
}
