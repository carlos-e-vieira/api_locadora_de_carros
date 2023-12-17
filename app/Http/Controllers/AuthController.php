<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function login(LoginFormRequest $loginFormRequest): JsonResponse
    {
        $credentials = $loginFormRequest->only('email', 'password');

        $token = auth('api')->attempt($credentials);

        if ($token === false) {
            return response()->json(['success' => false, 'error' => 'Usuário ou senha inválido'], Response::HTTP_FORBIDDEN);
        }

        return response()->json(['success' => true, 'token' => $token], Response::HTTP_OK);
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
