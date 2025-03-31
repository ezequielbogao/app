<?php

use App\Http\Controllers\Gdd\AuthController;
use App\Http\Controllers\gdd\DeudorController;
use App\Http\Controllers\Gdd\GestionController;
use Illuminate\Support\Facades\Route;

Route::prefix('gdd')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('gdd.login');
    Route::get('/', [DeudorController::class, 'dashboard'])->name('gdd.dashboard');
    Route::get('/deudores', [DeudorController::class, 'index'])->name('gdd.deudores');
    Route::post('/deudor-data', [DeudorController::class, 'getData'])->name('deudor.data');

    Route::get('/gestiones', [GestionController::class, 'index'])->name('gdd.gestiones.index');
    Route::get('/gestiones/{id}', [GestionController::class, 'edit'])->name('gdd.gestiones.edit');
    Route::post('/gestion-create', [GestionController::class, 'create'])->name('gdd.gestion.create');
});


Route::prefix('test')->group(function () {
    Route::get('/', function () {
        return view('test.main');
    });
});


Route::get('/', function () {
    return view('home');
});
