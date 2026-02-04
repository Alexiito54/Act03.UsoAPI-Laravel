<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    // Listar todos los animales
    public function index()
    {
        $animales = Animal::with('dueno')->get();
        return response()->json($animales);
    }

    // Crear nuevo animal
    public function store(Request $request)
    {
        $validacion = $request->validate([
            'nombre' => 'required|string|max:30',
            'tipo' => 'required|in:perro,gato,hámster,conejo',
            'peso' => 'required|numeric|min:0',
            'enfermedad' => 'required|string|max:50',
            'comentarios' => 'nullable|string',
            'id_persona' => 'required|exists:duenos,id_persona'
        ]);

        $animal = Animal::create($validacion);
        
        return response()->json([
            'mensaje' => 'Animal registrado ',
            'animal' => $animal->load('dueno')
        ], 201);
    }

    // Ver un animal especifico
    public function show($id)
    {
        $animal = Animal::with('dueno')->find($id);
        
        if (!$animal) {
            return response()->json([
                'error' => 'Animal no encontrado'
            ], 404);
        }
        
        return response()->json($animal);
    }

    // Actualizar animal
    public function update(Request $request, $id)
    {
        $animal = Animal::find($id);
        
        if (!$animal) {
            return response()->json([
                'error' => 'Animal no encontrado'
            ], 404);
        }

        $validacion = $request->validate([
            'nombre' => 'sometimes|required|string|max:30',
            'tipo' => 'sometimes|required|in:perro,gato,hámster,conejo',
            'peso' => 'sometimes|required|numeric|min:0',
            'enfermedad' => 'sometimes|required|string|max:50',
            'comentarios' => 'nullable|string',
            'id_persona' => 'sometimes|required|exists:duenos,id_persona'
        ]);

        $animal->update($validacion);
        
        return response()->json([
            'mensaje' => 'Animal actualizado',
            'animal' => $animal->load('dueno')
        ]);
    }

    // Eliminar animal
    public function destroy($id)
    {
        $animal = Animal::find($id);
        
        if (!$animal) {
            return response()->json([
                'error' => 'Animal no encontrado'
            ], 404);
        }

        $animal->delete();
        
        return response()->json([
            'mensaje' => 'Animal eliminado '
        ]);
    }
}
