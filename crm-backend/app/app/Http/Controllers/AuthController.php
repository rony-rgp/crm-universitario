<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario; // Modelo de usuario correcto

class AuthController extends Controller
{
    /**
     * Maneja la autenticación de usuarios y emite un token de Sanctum (US-01).
     */
    public function login(Request $request)
    {
        // 1. Validar las credenciales
        $credentials = $request->validate([
            'correo' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Buscar al usuario en la base de datos por correo
        $user = Usuario::where('correo', $credentials['correo'])->first();

        // 3. Autenticar: Verificar si el usuario existe Y si la contraseña coincide.
        // Si el usuario no existe o el hash no coincide, devuelve 401.
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
             return response()->json([
                 'message' => 'Credenciales inválidas.' // Mensaje genérico por seguridad
             ], 401);
        }
        
        // --- Si llegamos aquí, el usuario es válido (200 OK) ---
        
        // 4. Crear el token de Sanctum
        $token = $user->createToken('auth_token', ['*']); 

        // 5. Devolver el token y los datos del usuario
        return response()->json([
            'access_token' => $token->plainTextToken,
            'token_type' => 'Bearer',
            'user' => [
                'id' => $user->id,
                'nombre' => $user->nombre,
                'correo' => $user->correo,
                'rol_id' => $user->rol_id,
            ]
        ], 200); // Código 200 para éxito
    }

    /**
     * US-02: Cierra la sesión (invalida el token de Sanctum).
     * Requiere autenticación con el token.
     */
    public function logout(Request $request)
    {
        // Obtiene el token actual del usuario autenticado y lo elimina.
        // Esto invalida el token inmediatamente, cerrando la sesión.
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Sesión cerrada exitosamente.'], 200);
    }
}