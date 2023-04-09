<?php

namespace App\Observers;

use App\Facades\Transacoes;
use App\Models\Naturalidade;

class NaturalidadeObserver
{
    public function created(Naturalidade $naturalidade)
    {
        //gravar transacao
        Transacoes::transacaoRecord(1, 'naturalidades', $naturalidade, $naturalidade);
    }

    public function updated(Naturalidade $naturalidade)
    {
        //gravar transacao
        $beforeData = $naturalidade->getOriginal();
        $laterData = $naturalidade->getAttributes();

        Transacoes::transacaoRecord(2, 'naturalidades', $beforeData, $laterData);
    }

    public function deleted(Naturalidade $naturalidade)
    {
        //gravar transacao
        Transacoes::transacaoRecord(3, 'naturalidades', $naturalidade, $naturalidade);
    }
}
