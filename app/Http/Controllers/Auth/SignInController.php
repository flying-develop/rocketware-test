<?php

namespace App\Http\Controllers\Auth;

use App\Actions\LoginUserAction;
use App\Helpers\TokenHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;

class SignInController extends Controller
{
    public function __invoke(LoginRequest $request, LoginUserAction $action): JsonResponse
    {
        $token = $action($request->only(['email', 'password']));

        return TokenHelper::respondWithToken($token, ['user' => auth()->user()]);
    }
}