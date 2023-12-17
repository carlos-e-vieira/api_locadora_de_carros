<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\BrandFormRequest;
use App\Services\BrandService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BrandController extends Controller
{
    private BrandService $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    public function index(BrandFormRequest $brandFormRequest): JsonResponse
    {      
        $response = $this->brandService->getAllBrandsPaginated($brandFormRequest->toArray());

        if ($response === null) {
            return $this->errorResponse('Erro ao listar as marcas', Response::HTTP_NOT_FOUND);
        }

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_OK);
    }

    public function store(BrandFormRequest $brandFormRequest): JsonResponse
    {
        $requestData = $brandFormRequest->only('name');

        $response = $this->brandService->saveBrand(array_merge($requestData));

        if ($response === null) {
            return $this->errorResponse('Erro ao cadastrar a marca', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_CREATED);
    }

    public function show(int $id): JsonResponse
    {
        $response = $this->brandService->getBrandById($id);
        
        if ($response === null) {
            return $this->errorResponse('Erro ao buscar a marca', Response::HTTP_NOT_FOUND);
        }

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_OK);
    }

    public function update(BrandFormRequest $brandFormRequest, int $id): JsonResponse
    {
        $requestData = $brandFormRequest->only('name');

        $response = $this->brandService->updateBrand($requestData, $id);

        if ($response === null) {
            return $this->errorResponse('Erro ao atualizar a marca', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_OK);
    }

    public function destroy(int $id): JsonResponse
    {
        $response = $this->brandService->deleteBrand($id);

        if ($response === false) {
            return $this->errorResponse('Erro ao deletar a marca', Response::HTTP_NOT_FOUND);
        }

        return response()->json(['success' => true, 'response' => 'Registro deletado com sucesso!'], Response::HTTP_OK);
    }

    private function errorResponse(string $message, int $statusCode): JsonResponse
    {
        return response()->json(['success' => false, 'error' => $message], $statusCode);
    }
}
