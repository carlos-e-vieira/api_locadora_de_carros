<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class SpecificationExceptions extends Exception
{
    private const ERROR_STATUSES = [
        'getAllSpecificationsPaginated' => Response::HTTP_NOT_FOUND,
        'saveSpecification' => Response::HTTP_UNPROCESSABLE_ENTITY,
        'getSpecificationById' => Response::HTTP_NOT_FOUND,
        'updateSpecification' => Response::HTTP_UNPROCESSABLE_ENTITY,
        'deleteSpecification' => Response::HTTP_NOT_FOUND,
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
