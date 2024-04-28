<?php

use App\Http\Controllers\ShortUrlsController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->as('v1:')->group(static function (): void {
    Route::post('/short-urls', [ShortUrlsController::class, 'index']);
});