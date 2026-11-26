<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GestorGastosController;
use App\Http\Controllers\GestorNotasController;
use App\Http\Controllers\ListaTareasController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PropinaController;
use App\Http\Controllers\ReservasController;
use App\Http\Controllers\CronometroController;



Route::view('/', 'home');

// 1. Tareas
Route::get('/listaTareas', [listaTareasController::class, 'index'])->name('listaTareas.index');
Route::post('/listaTareas/store', [listaTareasController::class, 'storeTarea'])->name('listaTareas.storeTarea');
Route::delete('/listaTareas/{tarea}', [ListaTareasController::class, 'destroyTarea'])->name('listaTareas.destroyTarea');
Route::patch('listaTareas/{tarea}/completar', [ListaTareasController::class, 'completar'])->name('listaTareas.completar');

// 2. Propinas
Route::get('/propinas', [PropinaController::class, 'index'])->name('propinas.index');
Route::post('/propinas/calcular', [PropinaController::class, 'calcular'])->name('propinas.calcular');

// 3. Contraseñas
Route::get('/passwords', [PasswordController::class, 'index'])->name('passwords.index');
Route::post('/passwords/generar', [PasswordController::class, 'generar'])->name('passwords.generar');

// 4. Gastos
Route::get('/gestorGastos', [GestorGastosController::class, 'index'])->name('gestorGastos.index');
Route::post('/gestorGastos/store', [GestorGastosController::class, 'storeGasto'])->name('gestorGastos.storeGasto');
Route::delete('/gestorGastos/{gasto}', [GestorGastosController::class, 'destroyGasto'])->name('gestorGastos.destroyGasto');

// 5. Reservas
Route::get('/reservas', [ReservasController::class, 'index'])->name('reservas.index');
Route::get('/reservas/create', [ReservasController::class, 'createReserva'])->name('reservas.createReserva');
Route::post('/reservas/store', [ReservasController::class, 'storeReserva'])->name('reservas.storeReserva');
Route::delete('/reservas/{reserva}', [ReservasController::class, 'destroyReserva'])->name('reservas.destroyReserva');

// 6. Notas
Route::get('/gestorNotas', [GestorNotasController::class, 'index'])->name('gestorNotas.index');
Route::get('/gestorNotas/create', [GestorNotasController::class, 'createNota'])->name('gestorNotas.createNota');
Route::get('/gestorNotas/edit/{nota}', [GestorNotasController::class, 'editNota'])->name('gestorNotas.editNota');
Route::post('/gestorNotas/store', [GestorNotasController::class, 'storeNota'])->name('gestorNotas.storeNota');
Route::put('/gestorNotas/update', [GestorNotasController::class, 'updateNota'])->name('gestorNotas.updateNota');
Route::delete('/gestorNotas/{nota}', [GestorNotasController::class, 'destroyNota'])->name('gestorNotas.destroyNota');

//7. Cronómetro
Route::get('/cronometro', [CronometroController::class, 'index'])->name('cronometro.index');
Route::post('/cronometro/vuelta', [CronometroController::class, 'storeVuelta'])->name('cronometro.storeVuelta');
Route::delete('/cronometro/vueltas', [CronometroController::class, 'limpiar'])->name(('cronometro.limpiar'));


//9. Calendario
