<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ApiController;

Route::get('/', [
    UsersController::class, 'ListTableUsers'
]);

Route::post('/', [
    ApiController::class, 'enviarDatos'
])->name('enviar-datos');
