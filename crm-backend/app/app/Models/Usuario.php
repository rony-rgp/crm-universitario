<?php

namespace App\Models;

// Importar el trait de Sanctum y otras dependencias
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Usar el trait de autenticación
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // <-- ¡ESTO ES LO IMPORTANTE!

// La clase debe llamarse Usuario
class Usuario extends Authenticatable
{
    // Usar los traits necesarios
    use HasApiTokens, HasFactory, Notifiable;

    // Sobrescribir el nombre de la tabla para usar 'usuarios' en lugar de 'users'
    protected $table = 'usuarios'; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'correo',
        'password',
        'rol_id', // Aseguramos que el rol_id se pueda asignar
        'activo', 
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'activo' => 'boolean', // Aseguramos que se maneje como booleano
    ];
}
