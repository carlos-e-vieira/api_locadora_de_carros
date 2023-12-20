<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Services\UserService;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    public function testShouldReturnAnInstance(): void
    {
        $userService = resolve(UserService::class);
        $className = get_class($userService);

        $this->assertEquals(UserService::class, $className);
    }
}
