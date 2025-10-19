<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EjecutivoController; // <--- ¡Importar el nuevo controlador!

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// [US-01] Rutas de Autenticación
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->get('/user', function (Illuminate\Http\Request $request) {
    return $request->user();
});

// --- NUEVA SECCIÓN: CRUD DE EJECUTIVOS ---
// Las rutas deben estar protegidas por autenticación y rol de Administrador (rol_id: 1)
Route::middleware(['auth:sanctum', 'role:1'])->group(function () {
    // Esto define las 5 rutas: GET, POST, GET/{id}, PUT/{id}, DELETE/{id}
    Route::resource('ejecutivos', EjecutivoController::class)->except(['create', 'edit']);
});