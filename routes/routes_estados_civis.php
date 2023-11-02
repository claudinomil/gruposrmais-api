<?php

use App\Http\Controllers\EstadoCivilController;

Route::prefix('estados_civis')->group(function () {
    Route::get('/index/{empresa_id}', [EstadoCivilController::class, 'index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/show/{id}', [EstadoCivilController::class, 'show'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/filter/{array_dados}/{empresa_id}', [EstadoCivilController::class, 'filter'])->middleware(['auth:api', 'scope:claudino']);
    Route::post('/store/{empresa_id}', [EstadoCivilController::class, 'store'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/update/{id}/{empresa_id}', [EstadoCivilController::class, 'update'])->middleware(['auth:api', 'scope:claudino']);
    Route::delete('/destroy/{id}/{empresa_id}', [EstadoCivilController::class, 'destroy'])->middleware(['auth:api', 'scope:claudino']);
});
