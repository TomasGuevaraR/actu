<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LibroContableEstadosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('libro_contable_estados')->insert([
            ['nombre' => 'Abierto', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Cerrado', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Aprobado', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
