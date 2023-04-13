<?php

use App\Http\Controllers\EquipamentosController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\LocaisController;
use App\Http\Controllers\ReservasController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TiposController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('tipo', [TiposController::class, 'listar'])->name('listar.tipos');
    Route::get('editar/tipo/{tipo_id}', [TiposController::class, 'show'])->name('editar.tipo');
    Route::get('create/tipo/',[TiposController::class,'create'])->name('create.tipo');
    Route::delete('deletar/tipo/{id}',[TiposController::class,'deletar'])->name('deletar.tipo');
    Route::post('store/tipo/',[TiposController::class , 'store'])->name('store.tipo');
    Route::patch('update/tipo/{id}',[TiposController::class , 'update'])->name('tipo.update');

    Route::resource('local', LocaisController::class);
    Route::resource('equipamento', EquipamentosController::class);
    Route::resource('clientes', ClientesController::class);
    Route::resource('reservas', ReservasController::class);
    Route::get('reservas/reserva/{id}', [ReservasController::class, 'devolucao'])->name('reservas.devolucao');
});