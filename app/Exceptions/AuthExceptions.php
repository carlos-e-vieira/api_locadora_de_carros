<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class AuthExceptions extends Exception
{
    private const ERROR_STATUSES = [
        'getToken' => Response::HTTP_FORBIDDEN,
    ];

    public function render($request)
    {
        $statusCode = $this->getStatusCode($this->getMessage());

        return response()->json(['success' => false, 'error' => $this->getMessage()], $statusCode);
    }

    public function getStatusCode(string $key): int
    {
        return self::ERROR_STATUSES[$key] ?? Response::HTTP_INTERNAL_SERVER_ERROR;
    }
}
