<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class EjecutivoController extends Controller
{
    // El ID del Rol Ejecutivo (ajusta si es necesario)
    const ROL_EJECUTIVO_ID = 3; 

    /**
     * GET /api/ejecutivos
     * Muestra una lista de todos los ejecutivos.
     */
    public function index()
    {
        // Solo retorna usuarios que son ejecutivos
        $ejecutivos = Usuario::where('rol_id', self::ROL_EJECUTIVO_ID)->get();

        return response()->json($ejecutivos, 200);
    }

    /**
     * POST /api/ejecutivos
     * Almacena un nuevo ejecutivo en la base de datos.
     */
    public function store(Request $request)
    {
        // 1. Validación estricta de datos de entrada
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:usuarios,correo',
            'password' => 'required|string|min:6',
        ]);

        // 2. Creación del ejecutivo
        $ejecutivo = Usuario::create([
            'nombre' => $validated['nombre'],
            'correo' => $validated['correo'],
            'password' => Hash::make($validated['password']),
            'rol_id' => self::ROL_EJECUTIVO_ID, // Asignar el rol Ejecutivo (ID: 3)
            'activo' => true,
        ]);

        return response()->json($ejecutivo, 201); // 201 Created
    }

    /**
     * GET /api/ejecutivos/{id}
     * Muestra un ejecutivo específico.
     */
    public function show($id)
    {
        // Buscar por ID, asegurando que el rol sea el de Ejecutivo
        $ejecutivo = Usuario::where('rol_id', self::ROL_EJECUTIVO_ID)
                            ->findOrFail($id);
        
        return response()->json($ejecutivo, 200);
    }

    /**
     * PUT/PATCH /api/ejecutivos/{id}
     * Actualiza un ejecutivo específico.
     */
    public function update(Request $request, $id)
    {
        $ejecutivo = Usuario::where('rol_id', self::ROL_EJECUTIVO_ID)
                            ->findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            // El correo es único, pero debe ignorar el ID del ejecutivo actual
            'correo' => ['sometimes', 'required', 'email', Rule::unique('usuarios', 'correo')->ignore($ejecutivo->id)],
            'password' => 'nullable|string|min:6',
        ]);

        $ejecutivo->nombre = $validated['nombre'] ?? $ejecutivo->nombre;
        $ejecutivo->correo = $validated['correo'] ?? $ejecutivo->correo;
        
        if (isset($validated['password'])) {
            $ejecutivo->password = Hash::make($validated['password']);
        }
        
        $ejecutivo->save();

        return response()->json($ejecutivo, 200);
    }

    /**
     * DELETE /api/ejecutivos/{id}
     * Elimina un ejecutivo específico.
     */
    public function destroy($id)
    {
        $ejecutivo = Usuario::where('rol_id', self::ROL_EJECUTIVO_ID)
                            ->findOrFail($id);
                            
        // Podrías cambiar esto a $ejecutivo->activo = false; $ejecutivo->save();
        // si quieres una eliminación suave (soft delete). Usaremos Hard Delete por ahora.
        $ejecutivo->delete();

        return response()->json(['message' => 'Ejecutivo eliminado con éxito.'], 200);
    }
}