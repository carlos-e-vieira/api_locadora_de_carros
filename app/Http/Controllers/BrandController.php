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

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_OK);
    }

    public function store(BrandFormRequest $brandFormRequest): JsonResponse
    {
        $requestData = $brandFormRequest->only('name');

        $response = $this->brandService->saveBrand($requestData);

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_CREATED);
    }

    public function show(int $id): JsonResponse
    {
        $response = $this->brandService->getBrandById($id);
        
        return response()->json(['success' => true, 'response' => $response], Response::HTTP_OK);
    }

    public function update(BrandFormRequest $brandFormRequest, int $id): JsonResponse
    {
        $requestData = $brandFormRequest->only('name');

        $response = $this->brandService->updateBrand($requestData, $id);

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_OK);
    }

    public function destroy(int $id): JsonResponse
    {
        $response = $this->brandService->deleteBrand($id);

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_OK);
    }
}
