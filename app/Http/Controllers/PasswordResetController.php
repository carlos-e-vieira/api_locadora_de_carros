<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\PasswordResetService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PasswordResetController extends Controller
{
    private PasswordResetService $passwordResetService;

    public function __construct(PasswordResetService $passwordResetService)
    {
        $this->passwordResetService = $passwordResetService;
    }

    public function resetPassword(User $user): JsonResponse
    {
        $this->passwordResetService->resetPassword($user);

        return response()->json(['success' => true, 'message' => 'Senha redefinida com sucesso'], Response::HTTP_OK);
    }
}
