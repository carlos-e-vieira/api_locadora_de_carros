<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CarModelFormRequest;
use App\Services\CarModelService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CarModelController extends Controller
{
    private CarModelService $carModelService;

    public function __construct(CarModelService $carModelService)
    {
        $this->carModelService = $carModelService;
    }

    public function index(CarModelFormRequest $carModelFormRequest): JsonResponse
    {      
        $response = $this->carModelService->getAllCarModelsPaginated($carModelFormRequest->toArray());

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_OK);
    }

    public function store(CarModelFormRequest $carModelFormRequest): JsonResponse
    {
        $requestData = $carModelFormRequest->only('brand_id', 'name', 'doors', 'seats', 'air_bag', 'abs');

        $response = $this->carModelService->saveCarModel($requestData);

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_CREATED);
    }

    public function show(int $id): JsonResponse
    {
        $response = $this->carModelService->getCarModelById($id);
        
        return response()->json(['success' => true, 'response' => $response], Response::HTTP_OK);
    }

    public function update(CarModelFormRequest $carModelFormRequest, int $id): JsonResponse
    {
        $requestData = $carModelFormRequest->only('brand_id', 'name', 'doors', 'seats', 'air_bag', 'abs');

        $response = $this->carModelService->updateCarModel($requestData, $id);

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_OK);
    }

    public function destroy(int $id): JsonResponse
    {
        $response = $this->carModelService->deleteCarModel($id);

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_OK);
    }
}
