<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Services\CustomerService;
use Tests\TestCase;

class CustomerServiceTest extends TestCase
{
    public function testShouldReturnAnInstance(): void
    {
        $customerService = resolve(CustomerService::class);
        $className = get_class($customerService);

        $this->assertEquals(CustomerService::class, $className);
    }
}
