<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\AdminEventoController;

/*
|--------------------------------------------------------------------------
| Agenda Cultural
|--------------------------------------------------------------------------
*/

Route::get('/', [EventoController::class, 'index'])->name('agenda');

Route::get('/agenda', [EventoController::class, 'index'])->name('agenda.index');

Route::get('/evento/{id}', [EventoController::class, 'show'])->name('evento.show');

Route::get('/evento/{id}/inscripcion', [EventoController::class, 'inscripcion'])
    ->name('evento.inscripcion');

Route::post('/evento/{id}/inscripcion', [EventoController::class, 'guardarInscripcion'])
    ->name('evento.guardarInscripcion');

Route::get('/evento/{id}/sincronizar', [EventoController::class, 'sincronizarInscripciones'])
    ->name('evento.sincronizar');

/*
|--------------------------------------------------------------------------
| Panel Administrador
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AdminEventoController::class, 'login'])
    ->name('admin.login');

Route::post('/admin/login', [AdminEventoController::class, 'validarLogin'])
    ->name('admin.validar');

Route::get('/admin/eventos', [AdminEventoController::class, 'index'])
    ->name('admin.eventos');

Route::get('/admin/eventos/crear', [AdminEventoController::class, 'crear'])
    ->name('admin.eventos.crear');

Route::post('/admin/eventos', [AdminEventoController::class, 'guardar'])
    ->name('admin.eventos.guardar');

Route::get('/admin/eventos/{id}/editar', [AdminEventoController::class, 'editar'])
    ->name('admin.eventos.editar');

Route::put('/admin/eventos/{id}', [AdminEventoController::class, 'actualizar'])
    ->name('admin.eventos.actualizar');

Route::delete('/admin/eventos/{id}', [AdminEventoController::class, 'eliminar'])
    ->name('admin.eventos.eliminar');