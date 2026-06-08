<<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;

Route::get('/', [EventoController::class, 'index'])->name('agenda');

Route::get('/agenda', [EventoController::class, 'index'])->name('agenda.index');

Route::get('/evento/{id}', [EventoController::class, 'show'])->name('evento.show');

Route::get('/evento/{id}/inscripcion', [EventoController::class, 'inscripcion'])->name('evento.inscripcion');

Route::post('/evento/{id}/inscripcion', [EventoController::class, 'guardarInscripcion'])->name('evento.guardarInscripcion');

Route::get('/evento/{id}/sincronizar', [EventoController::class, 'sincronizarInscripciones'])
    ->name('evento.sincronizar');