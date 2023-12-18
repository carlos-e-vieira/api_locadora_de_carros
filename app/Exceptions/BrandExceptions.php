<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class BrandExceptions extends Exception
{
    private string $error;

    private int $statusCode;

    public function render($request)
    {
        if ($this->getMessage() === 'getAllBrandsPaginated') {
            $this->error = 'Erro ao listar os dados das marcas';
            $this->statusCode = Response::HTTP_NOT_FOUND;
        }

        if ($this->getMessage() === 'saveBrand') {
            $this->error = 'Erro ao cadastrar os dados da marca';
            $this->statusCode = Response::HTTP_UNPROCESSABLE_ENTITY;
        }

        if ($this->getMessage() === 'getBrandById') {
            $this->error = 'Erro ao listar os dados da marca';
            $this->statusCode = Response::HTTP_NOT_FOUND;
        }

        if ($this->getMessage() === 'updateBrand') {
            $this->error = 'Erro ao atualizar os dados da marca';
            $this->statusCode = Response::HTTP_UNPROCESSABLE_ENTITY;
        }

        if ($this->getMessage() === 'deleteBrand') {
            $this->error = 'Erro ao deletar os dados da marca';
            $this->statusCode = Response::HTTP_NOT_FOUND;
        }

        return response()->json(['success' => false,'error' => $this->getError()], $this->getStatusCode());
    }

    public function getError(): string
    {
        return $this->error;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
