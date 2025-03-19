<?php

use App\Http\Controllers\gdd\DeudorController;
use Illuminate\Support\Facades\Route;

Route::prefix('gdd')->group(function () {
    Route::get('/', [DeudorController::class, 'dashboard']);
    Route::get('/deudores', [DeudorController::class, 'deudores']);
    Route::get('/gestion', [DeudorController::class, 'gestion']);
});


Route::prefix('test')->group(function () {
    Route::get('/', function () {
        return view('test.main');
    });
});
