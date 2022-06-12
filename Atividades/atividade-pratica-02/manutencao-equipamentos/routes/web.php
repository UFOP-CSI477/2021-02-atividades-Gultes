<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\{RegistroController, EquipamentoController, UserController};

Route::get('/', [EquipamentoController::class, 'index'])->name('index');

Auth::routes();

Route::middleware('auth')->name('sistema.')->prefix('sistema')->group(function () {
    Route::name('equipamento.')->prefix('equipamento')->group(function () {
        Route::get('/equipamentos', [EquipamentoController::class, 'equipamentosAdm'])->name('index');
        Route::get('/novo-equipamento', [EquipamentoController::class, 'create'])->name('create');
        Route::post('/store', [EquipamentoController::class, 'store'])->name('store');
        Route::get('/editar/{id}', [EquipamentoController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [EquipamentoController::class, 'update'])->name('update');
        Route::delete('/deletar', [EquipamentoController::class, 'destroy'])->name('delete');
    });

    Route::name('registro.')->prefix('registro')->group(function () {
        Route::get('/', [RegistroController::class, 'index'])->name('index');
        Route::get('/novo-registro', [RegistroController::class, 'create'])->name('create');
        Route::post('/store', [RegistroController::class, 'store'])->name('store');
        Route::get('/editar/{id}', [RegistroController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [RegistroController::class, 'update'])->name('update');
        Route::delete('/deletar', [RegistroController::class, 'destroy'])->name('delete');
        Route::get('/relatorio', [RegistroController::class, 'relatorio'])->name('relatorio');
    });

    Route::name('users.')->prefix('users')->group(function() {
        Route::get('/relatorio',[UserController::class, 'relatorio'])->name('relatorio');
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
