<?php

namespace App\Observers;

use App\Facades\Transacoes;
use App\Models\Modulo;

class ModuloObserver
{
    public function created(Modulo $modulo)
    {
        //gravar transacao
        Transacoes::transacaoRecord(1, 'modulos', $modulo, $modulo);
    }

    public function updated(Modulo $modulo)
    {
        //gravar transacao
        $beforeData = $modulo->getOriginal();
        $laterData = $modulo->getAttributes();

        Transacoes::transacaoRecord(2, 'modulos', $beforeData, $laterData);
    }

    public function deleted(Modulo $modulo)
    {
        //gravar transacao
        Transacoes::transacaoRecord(3, 'modulos', $modulo, $modulo);
    }
}
