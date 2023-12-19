<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class CustomerExceptions OrchestratorException
{
    protected $errorStatuses = [
        'getAllCustomersPaginated' => Response::HTTP_NOT_FOUND,
        'saveCustomer' => Response::HTTP_UNPROCESSABLE_ENTITY,
        'getCustomerById' => Response::HTTP_NOT_FOUND,
        'updateCustomer' => Response::HTTP_UNPROCESSABLE_ENTITY,
        'deleteCustomer' => Response::HTTP_NOT_FOUND,
    ];
}
