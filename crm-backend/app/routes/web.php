<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; // <-- ¡Importar el controlador!

Route::get('/', function () {
    return view('welcome');
});

// [US-01] Ruta de autenticación (Login)
// Esta ruta se cargará correctamente en http://localhost:8000/login
Route::post('/login', [AuthController::class, 'login']);
