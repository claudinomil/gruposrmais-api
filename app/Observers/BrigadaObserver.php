<?php

namespace App\Observers;

use App\Facades\Transacoes;
use App\Models\Brigada;

class BrigadaObserver
{
    public function created(Brigada $brigada)
    {
        //gravar transacao
        Transacoes::transacaoRecord(1, 1, 'brigadas', $brigada, $brigada);
    }

    public function updated(Brigada $brigada)
    {
        //gravar transacao
        $beforeData = $brigada->getOriginal();
        $laterData = $brigada->getAttributes();

        Transacoes::transacaoRecord(1, 2, 'brigadas', $beforeData, $laterData);
    }

    public function deleted(Brigada $brigada)
    {
        //gravar transacao
        Transacoes::transacaoRecord(1, 3, 'brigadas', $brigada, $brigada);
    }
}
