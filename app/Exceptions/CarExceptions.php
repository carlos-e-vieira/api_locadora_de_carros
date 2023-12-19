<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Http\Response;

class CarExceptions extends OrchestratorException
{
    protected $errorStatuses = [
        'getAllCarsPaginated' => Response::HTTP_NOT_FOUND,
        'saveCar' => Response::HTTP_UNPROCESSABLE_ENTITY,
        'getCarById' => Response::HTTP_NOT_FOUND,
        'updateCar' => Response::HTTP_UNPROCESSABLE_ENTITY,
        'deleteCar' => Response::HTTP_NOT_FOUND,
    ];
}
