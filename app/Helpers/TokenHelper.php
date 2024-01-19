<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class TokenHelper
{
    public static function respondWithToken(string $token, array $additional = []) : JsonResponse
    {
        return response()->json(
            array_merge([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60
            ], $additional)
        );
    }
}