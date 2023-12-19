<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Exceptions\BrandExceptions;
use App\Repositories\BrandRepository;
use App\Services\BrandService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use PHPUnit\Framework\TestCase;

class BrandServiceTest extends TestCase
{
    public function testGetAllBrandsPaginated(): void
    {
        // Mock the BrandRepository
        $brandRepository = $this->createMock(BrandRepository::class);
        $brands = new LengthAwarePaginator([], 0, 15);
        $brandRepository->expects($this->once())
            ->method('getAll')
            ->willReturn($brands);

        // Create the BrandService with the mocked repository
        $brandService = new BrandService($brandRepository);

        // Assert that the service method returns the expected result
        $this->assertSame($brands, $brandService->getAllBrandsPaginated([]));
    }

    // Add similar test methods for other methods in BrandService

    public function testExceptionThrownWhenRepositoryReturnsEmptyData(): void
    {
        // Mock the BrandRepository
        $brandRepository = $this->createMock(BrandRepository::class);
        $brandRepository->expects($this->once())
            ->method('getAll')
            ->willReturn([]);

        // Create the BrandService with the mocked repository
        $brandService = new BrandService($brandRepository);

        // Expecting a BrandExceptions to be thrown
        $this->expectException(BrandExceptions::class);

        // Call the service method that should throw the exception
        $brandService->getAllBrandsPaginated([]);
    }
}
