<?php

namespace App\Http\Controllers;

use App\Providers\TinyUrlServiceProvider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ShortUrlsController extends Controller
{
    
    private const PARAM_URL = 'url';
    private const RESPONSE_SUCCESS = 'success';
    private const RESPONSE_URL = 'url';
    
    public function index(Request $request, TinyUrlServiceProvider $tinyUrl): JsonResponse
    {
        if ($this->verifyToken($request)) {
            if (!is_null($sourceUrl = $request->get(self::PARAM_URL))) {
                $destinationUrl = $tinyUrl->getUrl($sourceUrl);

                return new JsonResponse([
                    self::RESPONSE_URL => $destinationUrl
                ]);
            }
        }
        return new JsonResponse([self::RESPONSE_SUCCESS => false], Response::HTTP_BAD_REQUEST);
    }
}
