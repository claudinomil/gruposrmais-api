<?php

use App\Http\Controllers\ClienteServicoController;

Route::prefix('qrcodes')->group(function () {
    Route::prefix('clientes_servicos')->group(function () {
        Route::get('/qrcode_dados/{id}', [ClienteServicoController::class, 'qrcode_dados'])->middleware(['auth:api', 'scope:claudino']);

        Route::get('/qrcode_informacoes/show/{id}', [ClienteServicoController::class, 'qrcode_informacoes']);
        Route::get('/qrcode_brigada_presenca/show/{id}', [ClienteServicoController::class, 'qrcode_brigada_presenca']);

        //Gravar Presença
        Route::put('/qrcode_gravar_presenca/{brigada_escala_id}', [ClienteServicoController::class, 'qrcode_gravar_presenca']);
    });
});
