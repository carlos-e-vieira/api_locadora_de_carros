<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class CustomerExceptions extends Exception
{
    private const ERROR_STATUSES = [
        'getAllCustomersPaginated' => Response::HTTP_NOT_FOUND,
        'saveCustomer' => Response::HTTP_UNPROCESSABLE_ENTITY,
        'getCustomerById' => Response::HTTP_NOT_FOUND,
        'updateCustomer' => Response::HTTP_UNPROCESSABLE_ENTITY,
        'deleteCustomer' => Response::HTTP_NOT_FOUND,
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
