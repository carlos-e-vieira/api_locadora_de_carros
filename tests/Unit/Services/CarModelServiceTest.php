<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Services\CarModelService;
use Tests\TestCase;

class CarModelServiceTest extends TestCase
{
    public function testShouldReturnAnInstance(): void
    {
        $carModelService = resolve(CarModelService::class);
        $className = get_class($carModelService);

        $this->assertEquals(CarModelService::class, $className);
    }
}
