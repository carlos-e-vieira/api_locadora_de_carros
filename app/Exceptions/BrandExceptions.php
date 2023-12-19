<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Http\Response;

class BrandExceptions extends OrchestratorException
{
    protected $errorStatuses = [
        'getAllBrandsPaginated' => Response::HTTP_NOT_FOUND,
        'saveBrand' => Response::HTTP_UNPROCESSABLE_ENTITY,
        'getBrandById' => Response::HTTP_NOT_FOUND,
        'updateBrand' => Response::HTTP_UNPROCESSABLE_ENTITY,
        'deleteBrand' => Response::HTTP_NOT_FOUND,
    ];
}
