<?php

use App\Http\Controllers\NacionalidadeController;

Route::prefix('nacionalidades')->group(function () {
    Route::get('/index/{empresa_id}', [NacionalidadeController::class, 'index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/show/{id}', [NacionalidadeController::class, 'show'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/filter/{array_dados}/{empresa_id}', [NacionalidadeController::class, 'filter'])->middleware(['auth:api', 'scope:claudino']);
    Route::post('/store/{empresa_id}', [NacionalidadeController::class, 'store'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/update/{id}/{empresa_id}', [NacionalidadeController::class, 'update'])->middleware(['auth:api', 'scope:claudino']);
    Route::delete('/destroy/{id}/{empresa_id}', [NacionalidadeController::class, 'destroy'])->middleware(['auth:api', 'scope:claudino']);
});
