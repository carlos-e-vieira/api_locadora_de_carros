<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Http\Response;

class CarModelExceptions extends OrchestratorException
{
    protected $errorStatuses = [
        'getAllCarModelsPaginated' => Response::HTTP_NOT_FOUND,
        'saveCarModel' => Response::HTTP_UNPROCESSABLE_ENTITY,
        'getCarModelById' => Response::HTTP_NOT_FOUND,
        'updateCarModel' => Response::HTTP_UNPROCESSABLE_ENTITY,
        'deleteCarModel' => Response::HTTP_NOT_FOUND,
    ];
}
