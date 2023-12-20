<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarModelSeeder extends Seeder
{
    public function run(): void
    {
        $sql = "
            INSERT INTO car_models (brand_id, name, doors, seats, air_bag, abs) VALUES 
            (1, 'Fusion', 4, 5, 1, 0)";

        DB::statement($sql);
    }
}
