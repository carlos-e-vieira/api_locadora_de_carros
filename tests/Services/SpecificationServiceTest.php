<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Services\SpecificationService;
use Tests\TestCase;

class SpecificationServiceTest extends TestCase
{
    public function testShouldReturnAnInstance(): void
    {
        $specificationService = resolve(SpecificationService::class);
        $className = get_class($specificationService);

        $this->assertEquals(SpecificationService::class, $className);
    }
}
