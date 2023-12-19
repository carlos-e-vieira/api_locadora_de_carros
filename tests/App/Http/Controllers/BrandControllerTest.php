<?php

declare(strict_types=1);

namespace Tests\App\Http\Controllers;

use Tests\TestCase;

# php artisan test --filter=BrandControllerTest
class BrandControllerTest extends TestCase
{
    # php artisan test --filter=BrandControllerTest::testIndexBrandController
    public function testIndexBrandController(): void
    {
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
}
