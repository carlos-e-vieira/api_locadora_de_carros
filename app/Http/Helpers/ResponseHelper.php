<?php

declare(strict_types=1);

namespace App\Http\Helpers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ResponseHelper
{
    public static function getResponse(object $response, string $contextName, string $action): JsonResponse
    {
        $messages = [
            'index' => 'Erro ao listar ' . $contextName . 's',
            'show' => 'Erro ao listar ' . $contextName,
            'update' => 'Erro ao atualizar a(o)' . $contextName,
            'post' => 'Erro ao cadastrar a(o)' . $contextName,
            'delete' => 'Erro ao deletar a(o)' . $contextName,
        ];

        $statusCode = Response::HTTP_OK;

        $responseData = ['success' => true, 'response' => $response];

        if ($response === null) {
            $statusCode = Response::HTTP_NOT_FOUND;

            if ($action === 'update' || $action === 'store') {
                $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY;
            }
        }

        if ($response !== null && $action === 'post') {
            $statusCode = Response::HTTP_CREATED;
        }

        $responseData['success'] = $statusCode === Response::HTTP_OK;

        return response()->json($responseData, $statusCode, ['message' => $messages[$action] ?? null]);
    }
}
