<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dueno; 

class DuenoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $duenos = Dueno::with('animales')->get();
        return response()->json($duenos);    
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar datos
        $validacion = $request->validate([
            'nombre' => 'required|string|max:25',
            'apellido' => 'required|string|max:50'
        ]);

        $dueno = Dueno::create($validacion);
        
        return response()->json([
            'mensaje' => 'Dueño creado ',
            'dueno' => $dueno
        ], 201);
    }

    // Obtener un dueño específico
    public function show($id)
    {
        $dueno = Dueno::with('animales')->find($id);
        
        if (!$dueno) {
            return response()->json([
                'error' => 'Dueño no encontrado'
            ], 404);
        }
        
        return response()->json($dueno);
    }

    // Actualizar dueño
    public function update(Request $request, $id)
    {
        $dueno = Dueno::find($id);
        
        if (!$dueno) {
            return response()->json([
                'error' => 'Dueño no encontrado'
            ], 404);
        }

        $validacion = $request->validate([
            'nombre' => 'sometimes|required|string|max:100',
            'apellido' => 'sometimes|required|string|max:100'
        ]);

        $dueno->update($validacion);
        
        return response()->json([
            'mensaje' => 'Dueño actualizado',
            'dueno' => $dueno
        ]);
    }

  // Eliminar dueño 
    public function destroy($id)
    {
        $dueno = Dueno::find($id);
        
        if (!$dueno) {
            return response()->json([
                'error' => 'Dueño no encontrado'
            ], 404);
        }

        $dueno->delete();
        
        return response()->json([
            'mensaje' => 'Dueño eliminado '
        ]);
    }
}
