<?php

namespace App\Actions;

use Illuminate\Http\JsonResponse;

class LoginUserAction
{
    public function __invoke(array $credentials) : JsonResponse|string
    {

        if (!$token = auth()->attempt($credentials)) {
            return response()->json([
                'error' => '401 Unauthorized'
            ], 401);
        }

        return $token;
    }
}