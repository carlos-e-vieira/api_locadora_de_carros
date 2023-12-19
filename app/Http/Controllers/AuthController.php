<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginFormRequest $loginFormRequest): JsonResponse
    {
        $credentials = $loginFormRequest->only('email', 'password');

        $response = $this->authService->getToken($credentials);

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_OK);
    }

    public function logout(): JsonResponse
    {
        auth('api')->logout();

        return response()->json(['logout' => true]);
    }

    public function refresh(): JsonResponse
    {
        $token = auth('api')->refresh();

        return response()->json(['token' => $token]);
    }

    public function me(): JsonResponse
    {
        return response()->json(auth()->user());
    }
}
