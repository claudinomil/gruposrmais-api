<?php

use App\Http\Controllers\BancoController;

Route::prefix('bancos')->group(function () {
    Route::get('/index', [BancoController::class, 'index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/show/{id}', [BancoController::class, 'show'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/search/{field}/{value}', [BancoController::class, 'search'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/research/{fieldSearch}/{fieldValue}/{fieldReturn}', [BancoController::class, 'research'])->middleware(['auth:api', 'scope:claudino']);
    Route::post('/store', [BancoController::class, 'store'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/update/{id}', [BancoController::class, 'update'])->middleware(['auth:api', 'scope:claudino']);
    Route::delete('/destroy/{id}', [BancoController::class, 'destroy'])->middleware(['auth:api', 'scope:claudino']);
});
