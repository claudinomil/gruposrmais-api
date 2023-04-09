<?php

namespace App\Observers;

use App\Facades\Transacoes;
use App\Models\Submodulo;

class SubmoduloObserver
{
    public function created(Submodulo $submodulo)
    {
        //gravar transacao
        Transacoes::transacaoRecord(1, 'submodulos', $submodulo, $submodulo);
    }

    public function updated(Submodulo $submodulo)
    {
        //gravar transacao
        $beforeData = $submodulo->getOriginal();
        $laterData = $submodulo->getAttributes();

        Transacoes::transacaoRecord(2, 'submodulos', $beforeData, $laterData);
    }

    public function deleted(Submodulo $submodulo)
    {
        //gravar transacao
        Transacoes::
        transacaoRecord(3, 'submodulos', $submodulo, $submodulo);
    }
}
