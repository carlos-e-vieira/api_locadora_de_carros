<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Services\BrandService;
use Tests\TestCase;

class BrandServiceTest extends TestCase
{
    public function testShouldReturnAnInstance(): void
    {
        $brandService = resolve(BrandService::class);
        $className = get_class($brandService);

        $this->assertEquals(BrandService::class, $className);
    }
}
