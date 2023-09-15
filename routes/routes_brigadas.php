<?php

use App\Http\Controllers\BrigadaController;

Route::prefix('brigadas')->group(function () {
    Route::get('/index/{empresa_id}', [BrigadaController::class, 'index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/show/{id}', [BrigadaController::class, 'show'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/search/{field}/{value}/{empresa_id}', [BrigadaController::class, 'search'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/update/{id}/{empresa_id}', [BrigadaController::class, 'update'])->middleware(['auth:api', 'scope:claudino']);

    //Escalas e Rondas
    Route::get('/escalas/{brigada_id}/{er_periodo_data_1}/{er_periodo_data_2}', [BrigadaController::class, 'escalas'])->middleware(['auth:api', 'scope:claudino']);

    Route::get('/ronda_cliente_seguranca_medidas/{op}/{brigada_escala_id}/{brigada_ronda_id}', [BrigadaController::class, 'ronda_cliente_seguranca_medidas']);
});
