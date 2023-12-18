<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Helpers\ResponseHelper;
use App\Http\Requests\CustomerFormRequest;
use App\Services\CustomerService;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    private CustomerService $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index(CustomerFormRequest $customerFormRequest): JsonResponse
    {      
        $response = $this->customerService->getAllCustomersPaginated($customerFormRequest->toArray());

        return ResponseHelper::getResponse($response, 'marca', __FUNCTION__);
    }

    public function store(CustomerFormRequest $customerFormRequest): JsonResponse
    {
        $requestData = $customerFormRequest->only('name');

        $response = $this->customerService->saveCustomer($requestData);

        return ResponseHelper::getResponse($response, 'marca', __FUNCTION__);
    }

    public function show(int $id): JsonResponse
    {
        $response = $this->customerService->getCustomerById($id);

        return ResponseHelper::getResponse($response, 'marca', __FUNCTION__);
    }

    public function update(CustomerFormRequest $customerFormRequest, int $id): JsonResponse
    {
        $requestData = $customerFormRequest->only('name');

        $response = $this->customerService->updateCustomer($requestData, $id);

        return ResponseHelper::getResponse($response, 'marca', __FUNCTION__);
    }

    public function destroy(int $id): JsonResponse
    {
        $response = $this->customerService->deleteCustomer($id);

        return ResponseHelper::getResponse($response, 'marca', __FUNCTION__);
    }
}
