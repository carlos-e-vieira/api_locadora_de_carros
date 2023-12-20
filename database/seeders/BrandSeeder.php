<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $sql = "
            INSERT INTO brands (name) VALUES ('FORD')
        ";

        DB::statement($sql);
    }
}
