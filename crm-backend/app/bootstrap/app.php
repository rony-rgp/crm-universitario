<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php', // Asegúrate de que tu ruta API esté definida
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // --- REGISTRO DEL MIDDLEWARE DE ROL ---
        $middleware->alias([
            // Alias 'role' para usarlo en las rutas como 'role:1' o 'role:3'
            'role' => \App\Http\Middleware\CheckRole::class, 
        ]);
        // ----------------------------------------
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();