<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $sql = "
            INSERT INTO users (name, email, password) VALUES 
            ('Vera Luiz Borges', '12378945678')";

        DB::statement($sql);
    }
}
