<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Services\CarService;
use Tests\TestCase;

class CarServiceTest extends TestCase
{
    public function testShouldReturnAnInstance(): void
    {
        $carService = resolve(CarService::class);
        $className = get_class($carService);

        $this->assertEquals(CarService::class, $className);
    }
}
