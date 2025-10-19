<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route; // ¡Importar Facade Route!
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    // ... (función register sin cambios)

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // === Carga manual de rutas API ===
        Route::prefix('api')
            ->middleware('api')
            ->group(base_path('routes/api.php'));
        // ================================
    }
}