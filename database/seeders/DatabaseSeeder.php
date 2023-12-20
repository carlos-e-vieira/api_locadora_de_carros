<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(CarModelSeeder::class);
        $this->call(CarSeeder::class);
    }
}
