<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\AuthExceptions;

class AuthService
{
    public function getToken(array $credentials): object
    {
        $token = auth('api')->attempt($credentials);

        if (empty($data)) {
            throw new AuthExceptions($token);
        }

        return $token;
    }
}
