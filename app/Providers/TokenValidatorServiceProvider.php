<?php

namespace App\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class TokenValidatorServiceProvider extends ServiceProvider {

    public function __construct(Application $app) {
        $this->app = $app;
    }

    public function register(): void {
        $this->app->singleton(TokenValidatorServiceProvider::class);
    }

    public function boot(): void {
        
    }
    
    public function validate(string $in): bool
    {
        return false;
    }
    
}
