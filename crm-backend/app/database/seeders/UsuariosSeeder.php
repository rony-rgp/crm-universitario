<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // Necesario para encriptar la contraseña

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Encontrar el ID del rol 'Administrador'
        $adminRolId = DB::table('roles')->where('nombre', 'Administrador')->value('id');

        // 2. Crear el usuario si el rol existe
        if ($adminRolId) {
            DB::table('usuarios')->insert([
                'nombre' => 'Admin General',
                'correo' => 'admin@universitario.com',
                'password' => Hash::make('password'), // La contraseña será 'password'
                'rol_id' => $adminRolId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
