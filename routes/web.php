<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController; // <-- Agrega esta línea

Route::get('/', function () {
    return view('welcome');
});

//asocia la URL y el metodo HTTP con el controlador
Route::resource('productos', ProductoController::class);
