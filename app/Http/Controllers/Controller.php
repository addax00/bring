<?php

namespace App\Http\Controllers;

use App\Providers\TokenValidatorServiceProvider;
use Illuminate\Http\Request;

abstract class Controller
{

    public function __construct(private TokenValidatorServiceProvider $tokenValidator)
    {
    }

    protected function verifyToken(Request $request): bool
    {
        return $this->tokenValidator->validate($request->bearerToken());
    }
}
