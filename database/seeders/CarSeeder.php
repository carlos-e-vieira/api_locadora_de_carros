<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        $sql = "
            INSERT INTO cars (car_model_id, plate, availability, km) VALUES 
            (1, 'ABC0123', 1, 2562)";

        DB::statement($sql);
    }
}
