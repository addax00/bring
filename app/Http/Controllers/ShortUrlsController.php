<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class ShortUrlsController extends Controller
{

    public function index(): JsonResponse
    {
        return new JsonResponse([
            'url' => '<https://example.com/12345>'
        ]);
    }    
}
