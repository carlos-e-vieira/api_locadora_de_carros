<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class BrandExceptions extends Exception
{
    private const ERROR_STATUSES = [
        'getAllBrandsPaginated' => Response::HTTP_NOT_FOUND,
        'saveBrand' => Response::HTTP_UNPROCESSABLE_ENTITY,
        'getBrandById' => Response::HTTP_NOT_FOUND,
        'updateBrand' => Response::HTTP_UNPROCESSABLE_ENTITY,
        'deleteBrand' => Response::HTTP_NOT_FOUND,
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
