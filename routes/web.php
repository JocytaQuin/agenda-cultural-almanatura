<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;

Route::get('/', [EventoController::class, 'index'])->name('agenda');

Route::get('/agenda', [EventoController::class, 'index'])->name('agenda.index');

Route::get('/evento/{id}', [EventoController::class, 'show'])->name('evento.show');