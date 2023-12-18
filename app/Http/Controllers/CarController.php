<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Helpers\ResponseHelper;
use App\Http\Requests\CarFormRequest;
use App\Services\CarService;
use Illuminate\Http\JsonResponse;

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

        return ResponseHelper::getResponse($response, 'carro', __FUNCTION__);
    }

    public function store(CarFormRequest $carFormRequest): JsonResponse
    {
        $requestData = $carFormRequest->only('specification_id', 'plate', 'availability', 'km');

        $response = $this->carService->saveCar($requestData);

        return ResponseHelper::getResponse($response, 'carro', __FUNCTION__);
    }

    public function show(int $id): JsonResponse
    {
        $response = $this->carService->getCarById($id);

        return ResponseHelper::getResponse($response, 'carro', __FUNCTION__);
    }

    public function update(CarFormRequest $carFormRequest, int $id): JsonResponse
    {
        $requestData = $carFormRequest->only('specification_id', 'plate', 'availability', 'km');

        $response = $this->carService->updateCar($requestData, $id);

        return ResponseHelper::getResponse($response, 'carro', __FUNCTION__);
    }

    public function destroy(int $id): JsonResponse
    {
        $response = $this->carService->deleteCar($id);

        return ResponseHelper::getResponse($response, 'carro', __FUNCTION__);
    }
}
