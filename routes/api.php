<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncidenciaController; // Asegúrate de importar el controlador

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/incidencias', [IncidenciaController::class, 'store']);
Route::get('/incidencias', [IncidenciaController::class, 'index']);
Route::delete('/incidencias/{id}', [IncidenciaController::class, 'destroy']);
Route::patch('/incidencias/{id}', [IncidenciaController::class, 'actualizarEstado']);
Route::get('/incidencias/totales', [IncidenciaController::class, 'contarIncidencias']);
