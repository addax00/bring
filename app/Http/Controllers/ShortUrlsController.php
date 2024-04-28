<?php

namespace App\Http\Controllers;

use App\Providers\TinyUrlServiceProvider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShortUrlsController extends Controller
{
    
    private const PARAM_URL = 'url';
    
    public function index(Request $request, TinyUrlServiceProvider $tinyUrl): JsonResponse
    {
        $sourceUrl = $request->get(self::PARAM_URL, '');
        $destinationUrl = $tinyUrl->getUrl($sourceUrl);
        
        return new JsonResponse([
            'url' => $destinationUrl
        ]);
    }    
}
