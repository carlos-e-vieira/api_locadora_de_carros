<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class BrandExceptions extends Exception
{
    private array $errorMessages = [
        'getAllBrandsPaginated' => [
            'message' => 'Erro ao listar os dados das marcas',
            'status' => Response::HTTP_NOT_FOUND,
        ],
        'saveBrand' => [
            'message' => 'Erro ao cadastrar os dados da marca',
            'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
        ],
        'getBrandById' => [
            'message' => 'Erro ao listar os dados da marca',
            'status' => Response::HTTP_NOT_FOUND,
        ],
        'updateBrand' => [
            'message' => 'Erro ao atualizar os dados da marca',
            'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
        ],
        'deleteBrand' => [
            'message' => 'Erro ao deletar os dados da marca',
            'status' => Response::HTTP_NOT_FOUND,
        ],
    ];

    public function render($request)
    {
        $errorMessage = $this->errorMessages[$this->getMessage()]['message'] ?? 'Erro desconhecido';
        $statusCode = $this->errorMessages[$this->getMessage()]['status'] ?? Response::HTTP_INTERNAL_SERVER_ERROR;

        return response()->json(['success' => false, 'error' => $errorMessage], $statusCode);
    }
}
