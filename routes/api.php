<?php

use App\Http\Controllers\ConsultaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('consulta/{pacienteId}', [ConsultaController::class, 'store']);

Route::prefix('patients')->group(function () {
    Route::controller(PatientController::class)->group(function () {
        Route::post('/', 'store');
        Route::get('/', 'index');
        Route::get('/{patient}', 'show');
        Route::get('/{patient}/consultations', 'consultations');
    });
});
