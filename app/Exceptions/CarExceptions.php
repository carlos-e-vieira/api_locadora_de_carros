<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class CarExceptions extends Exception
{
    private const ERROR_STATUSES = [
        'getAllCarsPaginated' => Response::HTTP_NOT_FOUND,
        'saveCar' => Response::HTTP_UNPROCESSABLE_ENTITY,
        'getCarById' => Response::HTTP_NOT_FOUND,
        'updateCar' => Response::HTTP_UNPROCESSABLE_ENTITY,
        'deleteCar' => Response::HTTP_NOT_FOUND,
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
