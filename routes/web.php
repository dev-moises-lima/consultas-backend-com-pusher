<?php

use App\Events\PacienteCadastrado;
use Illuminate\Support\Facades\Route;

// Route::get('/teste', function () {
//     broadcast(new PacienteCadastrado());
//     return 'paciente cadastrado';
// });

Route::get('/', function () {
    return view('welcome');
});
