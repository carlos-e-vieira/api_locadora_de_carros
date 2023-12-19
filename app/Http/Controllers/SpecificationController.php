<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\SpecificationFormRequest;
use App\Services\SpecificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class SpecificationController extends Controller
{
    private SpecificationService $specificationService;

    public function __construct(SpecificationService $specificationService)
    {
        $this->specificationService = $specificationService;
    }

    public function index(SpecificationFormRequest $specificationFormRequest): JsonResponse
    {      
        $response = $this->specificationService->getAllSpecificationsPaginated($specificationFormRequest->toArray());

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_OK);
    }

    public function store(SpecificationFormRequest $specificationFormRequest): JsonResponse
    {
        $requestData = $specificationFormRequest->only('brand_id', 'name', 'doors', 'seats', 'air_bag', 'abs');

        $response = $this->specificationService->saveSpecification($requestData);

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_CREATED);
    }

    public function show(int $id): JsonResponse
    {
        $response = $this->specificationService->getSpecificationById($id);
        
        return response()->json(['success' => true, 'response' => $response], Response::HTTP_OK);
    }

    public function update(SpecificationFormRequest $specificationFormRequest, int $id): JsonResponse
    {
        $requestData = $specificationFormRequest->only('brand_id', 'name', 'doors', 'seats', 'air_bag', 'abs');

        $response = $this->specificationService->updateSpecification($requestData, $id);

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_OK);
    }

    public function destroy(int $id): JsonResponse
    {
        $response = $this->specificationService->deleteSpecification($id);

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_OK);
    }
}
