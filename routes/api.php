<?php

use App\Http\Controllers\ConsultaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::post('consulta/{pacienteId}', [ConsultaController::class, 'store']);

Route::controller(PacienteController::class)->group(function () {
    Route::get('pacientes/{pacienteId}/consultas', 'obterConsultas');
    Route::post('pacientes', 'store');
    Route::get('pacientes', 'obterTodos');
    Route::get('pacientes/{pacienteId}', 'obterUm');
});
