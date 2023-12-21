<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use App\Mail\PasswordReset;
use Illuminate\Support\Facades\Mail;

class PasswordResetService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function resetPassword(User $user): void
    {
        $newPassword = $this->generateRandomPassword();

        $this->userRepository->updatePassword($user, $newPassword);
        $this->sendPasswordResetEmail($user, $newPassword);
    }

    private function generateRandomPassword($length = 10): string
    {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

    private function sendPasswordResetEmail(User $user, $newPassword): void
    {
        Mail::to($user->email)->send(new PasswordReset($user, $newPassword));
    }
}
