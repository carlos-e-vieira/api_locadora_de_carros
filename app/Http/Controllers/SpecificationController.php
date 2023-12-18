<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Helpers\ResponseHelper;
use App\Http\Requests\SpecificationFormRequest;
use App\Services\SpecificationService;
use Illuminate\Http\JsonResponse;

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

        return ResponseHelper::getResponse($response, 'modelo', __FUNCTION__);
    }

    public function store(SpecificationFormRequest $specificationFormRequest): JsonResponse
    {
        $requestData = $specificationFormRequest->only(
            'brand_id', 
            'name', 
            'doors', 
            'seats', 
            'air_bag', 
            'abs'
        );

        $response = $this->specificationService->saveSpecification($requestData);

        return ResponseHelper::getResponse($response, 'modelo', __FUNCTION__);
    }

    public function show(int $id): JsonResponse
    {
        $response = $this->specificationService->getSpecificationById($id);

        return ResponseHelper::getResponse($response, 'modelo', __FUNCTION__);
    }

    public function update(SpecificationFormRequest $specificationFormRequest, int $id): JsonResponse
    {
        $requestData = $specificationFormRequest->only(
            'brand_id', 
            'name', 
            'doors', 
            'seats', 
            'air_bag', 
            'abs'
        );

        $response = $this->specificationService->updateSpecification($requestData, $id);

        return ResponseHelper::getResponse($response, 'modelo', __FUNCTION__);
    }

    public function destroy(int $id): JsonResponse
    {
        $response = $this->specificationService->deleteSpecification($id);

        return ResponseHelper::getResponse($response, 'modelo', __FUNCTION__);
    }
}
