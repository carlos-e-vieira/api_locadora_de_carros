<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $hash = Hash::make('1234');

        $sql = "
            INSERT INTO users (name, email, password) VALUES 
            ('Carlos Eduardo Vieira', 'carlos@teste.com.br', '$hash')";

        DB::statement($sql);
    }
}
