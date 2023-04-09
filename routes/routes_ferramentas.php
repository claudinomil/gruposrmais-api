<?php

use App\Http\Controllers\FerramentaController;

Route::prefix('ferramentas')->group(function () {
    Route::get('/index', [FerramentaController::class, 'index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/show/{id}', [FerramentaController::class, 'show'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/search/{field}/{value}', [FerramentaController::class, 'search'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/research/{fieldSearch}/{fieldValue}/{fieldReturn}', [FerramentaController::class, 'research'])->middleware(['auth:api', 'scope:claudino']);
    Route::post('/store', [FerramentaController::class, 'store'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/update/{id}', [FerramentaController::class, 'update'])->middleware(['auth:api', 'scope:claudino']);
    Route::delete('/destroy/{id}', [FerramentaController::class, 'destroy'])->middleware(['auth:api', 'scope:claudino']);
});
