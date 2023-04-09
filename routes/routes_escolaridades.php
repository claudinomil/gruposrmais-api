<?php

use App\Http\Controllers\EscolaridadeController;

Route::prefix('escolaridades')->group(function () {
    Route::get('/index', [EscolaridadeController::class, 'index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/show/{id}', [EscolaridadeController::class, 'show'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/search/{field}/{value}', [EscolaridadeController::class, 'search'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/research/{fieldSearch}/{fieldValue}/{fieldReturn}', [EscolaridadeController::class, 'research'])->middleware(['auth:api', 'scope:claudino']);
    Route::post('/store', [EscolaridadeController::class, 'store'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/update/{id}', [EscolaridadeController::class, 'update'])->middleware(['auth:api', 'scope:claudino']);
    Route::delete('/destroy/{id}', [EscolaridadeController::class, 'destroy'])->middleware(['auth:api', 'scope:claudino']);
});
