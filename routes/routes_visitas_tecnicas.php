<?php

use App\Http\Controllers\VisitaTecnicaController;

Route::prefix('visitas_tecnicas')->group(function () {
    Route::get('/index/{empresa_id}', [VisitaTecnicaController::class, 'index'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/show/{id}', [VisitaTecnicaController::class, 'show'])->middleware(['auth:api', 'scope:claudino']);
    Route::get('/search/{field}/{value}/{empresa_id}', [VisitaTecnicaController::class, 'search'])->middleware(['auth:api', 'scope:claudino']);
    Route::put('/update/{id}/{empresa_id}', [VisitaTecnicaController::class, 'update'])->middleware(['auth:api', 'scope:claudino']);

    Route::get('/auxiliary/tables/{empresa_id}', [VisitaTecnicaController::class, 'auxiliary'])->middleware(['auth:api', 'scope:claudino']);

    Route::get('/medidas_seguranca/{np}/{atc}/{grupo}/{divisao}', [VisitaTecnicaController::class, 'medidas_seguranca'])->middleware(['auth:api', 'scope:claudino']);
});
