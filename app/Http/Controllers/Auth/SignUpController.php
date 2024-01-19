<?php

namespace App\Http\Controllers\Auth;

use App\Actions\RegisterUserAction;
use App\Helpers\TokenHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\JsonResponse;

class SignUpController extends Controller
{
    public function __invoke(RegisterRequest $request, RegisterUserAction $action): JsonResponse
    {

        $token = $action($request->validated());

        return TokenHelper::respondWithToken($token, ['user' => auth()->user()]);
    }
}