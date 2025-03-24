<?php

use App\Http\Controllers\gdd\DeudorController;
use App\Http\Controllers\Gdd\GestionController;
use Illuminate\Support\Facades\Route;

Route::prefix('gdd')->group(function () {
    Route::get('/', [DeudorController::class, 'dashboard']);
    Route::get('/deudores', [DeudorController::class, 'index']);
    Route::post('/deudor-data', [DeudorController::class, 'getData'])->name('deudor.data');

    Route::get('/gestion', [GestionController::class, 'index']);
    Route::post('/gestion-create', [GestionController::class, 'create'])->name('gestion.create');
});


Route::prefix('test')->group(function () {
    Route::get('/', function () {
        return view('test.main');
    });
});
