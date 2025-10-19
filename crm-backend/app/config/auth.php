<?php

use App\Models\Usuario; // Importa tu modelo 'Usuario'

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | Usaremos 'api' como el guard por defecto para las peticiones de API.
    |
    */

    'defaults' => [
        // Cambiamos el guard por defecto a 'api'
        'guard' => env('AUTH_GUARD', 'api'), 
        'passwords' => env('AUTH_PASSWORD_BROKER', 'usuarios'), // Usar el nuevo provider
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Definimos dos guards: 'web' para sesiones y 'api' para tokens.
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'usuarios', // Apuntar al nuevo proveedor 'usuarios'
        ],

        // ** AGREGAMOS EL GUARD 'API' PARA SANCTUM **
        'api' => [
            'driver' => 'sanctum',
            'provider' => 'usuarios', // Apuntar a nuestro proveedor 'usuarios'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | Definimos el proveedor 'usuarios' para que apunte a tu modelo correcto.
    |
    */

    'providers' => [
        'usuarios' => [ // Cambiamos el nombre del proveedor a 'usuarios'
            'driver' => 'eloquent',
            // Apuntamos al modelo que renombraste a Usuario.php
            'model' => Usuario::class, 
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | Configuramos el broker de contraseñas para que use el proveedor 'usuarios'.
    |
    */

    'passwords' => [
        'usuarios' => [ // Cambiamos el nombre del broker a 'usuarios'
            'provider' => 'usuarios',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];