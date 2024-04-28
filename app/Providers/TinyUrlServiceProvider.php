<?php

namespace App\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class TinyUrlServiceProvider extends ServiceProvider {

    private const ENDPOINT = 'https://tinyurl.com/api-create.php';
    private const PARAM_URL = 'url';

    public function __construct(Application $app) {
        $this->app = $app;
    }

    public function register(): void {
        $this->app->singleton(TinyUrlServiceProvider::class);
    }

    public function boot(): void {
        
    }

    public function getUrl(string $sourceUrl): string
    {
        try {
            $response = Http::withoutVerifying()->get(self::ENDPOINT, [
                self::PARAM_URL => $sourceUrl
            ]);
            return $response->body();
        } catch (Exception $ex) {
            
        }

        return '';
    }
}
