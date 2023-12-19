<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Http\Response;

class SpecificationExceptions extends OrchestratorException
{
    protected $errorStatuses = [
        'getAllSpecificationsPaginated' => Response::HTTP_NOT_FOUND,
        'saveSpecification' => Response::HTTP_UNPROCESSABLE_ENTITY,
        'getSpecificationById' => Response::HTTP_NOT_FOUND,
        'updateSpecification' => Response::HTTP_UNPROCESSABLE_ENTITY,
        'deleteSpecification' => Response::HTTP_NOT_FOUND,
    ];
}
