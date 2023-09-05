<?php

namespace App\Observers;

use App\Facades\Transacoes;
use App\Models\Servico;

class ServicoObserver
{
    public function created(Servico $servico)
    {
        //gravar transacao
        Transacoes::transacaoRecord(1, 1, 'servicos', $servico, $servico);
    }

    public function updated(Servico $servico)
    {
        //gravar transacao
        $beforeData = $servico->getOriginal();
        $laterData = $servico->getAttributes();

        Transacoes::transacaoRecord(1, 2, 'servicos', $beforeData, $laterData);
    }

    public function deleted(Servico $servico)
    {
        //gravar transacao
        Transacoes::transacaoRecord(1, 3, 'servicos', $servico, $servico);
    }
}
