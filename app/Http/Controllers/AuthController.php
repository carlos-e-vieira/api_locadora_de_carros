<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function login(LoginFormRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');
        $token = auth('api')->attempt($credentials);

        if ($token === false) {
            return response()->json([
                'success' => 'false',
                'erro' => 'Usuário ou senha inválido'
            ], 403);
        }

        return response()->json([
            'success' => 'true', 
            'token' => $token
        ], 200);
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
