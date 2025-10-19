<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NegativeReasonsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('negative_reasons')->insert([
            ['nombre' => 'Prefiere otra institución'],
            ['nombre' => 'Motivo económico'],
            ['nombre' => 'Carrera no disponible'],
            ['nombre' => 'Sin interés'],
        ]);
    }
}
