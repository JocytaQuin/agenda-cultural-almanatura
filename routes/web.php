<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\InscripcionController;

Route::get('/', [EventoController::class, 'index']);

Route::get('/evento/{id}', [EventoController::class, 'show']);

Route::get('/evento/{id}/inscripcion', [InscripcionController::class, 'create']);

Route::post('/evento/{id}/inscripcion', [InscripcionController::class, 'store']);