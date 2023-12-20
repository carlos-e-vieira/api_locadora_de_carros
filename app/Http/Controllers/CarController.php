<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CarFormRequest;
use App\Services\CarService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CarController extends Controller
{
    private CarService $carService;

    public function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }

    public function index(CarFormRequest $carFormRequest): JsonResponse
    {      
        $response = $this->carService->getAllCarsPaginated($carFormRequest->toArray());

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_OK);
    }

    public function store(CarFormRequest $carFormRequest): JsonResponse
    {
        $requestData = $carFormRequest->only('car_model_id', 'plate', 'availability', 'km');

        $response = $this->carService->saveCar($requestData);

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_CREATED);
    }

    public function show(int $id): JsonResponse
    {
        $response = $this->carService->getCarById($id);
        
        return response()->json(['success' => true, 'response' => $response], Response::HTTP_OK);
    }

    public function update(CarFormRequest $carFormRequest, int $id): JsonResponse
    {
        $requestData = $carFormRequest->only('car_model_id', 'plate', 'availability', 'km');

        $response = $this->carService->updateCar($requestData, $id);

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_OK);
    }

    public function destroy(int $id): JsonResponse
    {
        $response = $this->carService->deleteCar($id);

        return response()->json(['success' => true, 'response' => $response], Response::HTTP_OK);
    }
}
