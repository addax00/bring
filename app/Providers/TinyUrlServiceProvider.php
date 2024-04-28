<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TinyUrlServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind('TinyUrlServiceProvider', TinyUrlServiceProvider::class);
    }

    public function boot(): void
    {
    }
    
    public function getUrl(string $sourceUrl): string
    {
        return '';
    }
}
