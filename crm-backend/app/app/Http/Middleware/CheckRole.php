<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $roleId): Response
    {
        // 1. Verificar si el usuario está autenticado
        if (! $request->user()) {
            return response()->json(['message' => 'No autenticado.'], 401);
        }

        // 2. Verificar el rol del usuario (rol_id debe ser igual al ID requerido)
        if ($request->user()->rol_id != $roleId) {
            return response()->json(['message' => 'Acceso denegado. Rol no autorizado.'], 403); // 403 Forbidden
        }

        return $next($request);
    }
}

 

  
 
 
  