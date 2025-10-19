<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['nombre' => 'Administrador', 'descripcion' => 'Acceso total al sistema'],
            ['nombre' => 'Supervisor', 'descripcion' => 'Coordina y revisa el trabajo de los ejecutivos'],
            ['nombre' => 'Ejecutivo', 'descripcion' => 'Registra y da seguimiento a estudiantes']
        ]);
    }
}
