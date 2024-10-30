<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incidencia; // Asegúrate de importar el modelo

class IncidenciaController extends Controller
{
    public function index()
    {
        $incidencias = Incidencia::all()->map(function ($incidencia) {
            $incidencia->imagen_url = asset('storage/' . $incidencia->archivo); // Asegúrate de que 'ruta_imagen' sea el campo correcto
            return $incidencia;
        });
    
        return $incidencias;
    }


    public function store(Request $request)
    {
        $request->validate([
            'dni' => 'required|string|max:8',
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'archivo' => 'nullable|image|mimes:jpg,jpeg|max:2048',
            'laboratorio' => 'required|string'
        ]);

        // Manejo del archivo
        $archivoPath = null;
        if ($request->hasFile('archivo')) {
            $archivoPath = $request->file('archivo')->store('incidencias', 'public');
        }

        // Guardar la incidencia
        Incidencia::create([
            'dni' => $request->dni,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'archivo' => $archivoPath,
            'laboratorio' => $request->laboratorio,
        ]);

        return response()->json(['message' => 'Incidencia registrada exitosamente'], 201);
    }

    public function actualizarEstado(Request $request, $id)
    {
        $incidencia = Incidencia::findOrFail($id);
        $incidencia->estado = $request->estado;
        $incidencia->save();
    
        return response()->json(['message' => 'Estado actualizado correctamente']);
    }


    public function contarIncidencias()
    {
        $totales = [
            'pendiente' => Incidencia::where('estado', 'pendiente')->count(),
            'recibido' => Incidencia::where('estado', 'recibido')->count(),
            'resuelto' => Incidencia::where('estado', 'resuelto')->count(),
            'en_proceso' => Incidencia::where('estado', 'en proceso')->count(),
        ];
    
        return response()->json($totales);
    }

}