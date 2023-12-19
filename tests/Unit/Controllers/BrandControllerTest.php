<?php

declare(strict_types=1);

namespace Tests\Unit\Controllers;

use App\Exceptions\BrandExceptions;
use App\Http\Controllers\BrandController;
use App\Http\Requests\BrandFormRequest;
use App\Services\BrandService;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Validation\ValidationException;
use PHPUnit\Framework\TestCase;

class BrandControllerTest extends TestCase
{
    public function testIndex(): void
    {
        // Mock the BrandFormRequest
        $brandFormRequest = $this->createMock(BrandFormRequest::class);

        // Mock the BrandService
        $brandService = $this->createMock(BrandService::class);

        $brands = new LengthAwarePaginator([], 0, 15);

        $brandService->expects($this->once())
            ->method('getAllBrandsPaginated')
            ->with($brandFormRequest->toArray())
            ->willReturn($brands);

        // Create the BrandController with the mocked dependencies
        $brandController = new BrandController($brandService);

        // Call the controller method and assert the response
        $response = $brandController->index($brandFormRequest);

        $expectedResponse = response()->json(['success' => true, 'response' => $brands], JsonResponse::HTTP_OK);
        
        $this->assertEquals($expectedResponse->getContent(), $response->getContent());
    }

    // Add similar test methods for other methods in BrandController

    public function testExceptionThrownWhenServiceThrowsException(): void
    {
        // Mock the BrandFormRequest
        $brandFormRequest = $this->createMock(BrandFormRequest::class);

        // Mock the BrandService to throw an exception
        $brandService = $this->createMock(BrandService::class);
        $brandService->expects($this->once())
            ->method('getAllBrandsPaginated')
            ->willThrowException(new BrandExceptions('Test Exception'));

        // Create the BrandController with the mocked dependencies
        $brandController = new BrandController($brandService);

        // Expecting a ValidationException to be thrown
        $this->expectException(BrandExceptions::class);

        // Call the controller method that should throw the exception
        $brandController->index($brandFormRequest);
    }
}
