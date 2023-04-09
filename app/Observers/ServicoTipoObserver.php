<?php

namespace App\Observers;

use App\Facades\Transacoes;
use App\Models\ServicoTipo;

class ServicoTipoObserver
{
    public function created(ServicoTipo $servico_tipo)
    {
        //gravar transacao
        Transacoes::transacaoRecord(1, 'servico_tipos', $servico_tipo, $servico_tipo);
    }

    public function updated(ServicoTipo $servico_tipo)
    {
        //gravar transacao
        $beforeData = $servico_tipo->getOriginal();
        $laterData = $servico_tipo->getAttributes();

        Transacoes::transacaoRecord(2, 'servico_tipos', $beforeData, $laterData);
    }

    public function deleted(ServicoTipo $servico_tipo)
    {
        //gravar transacao
        Transacoes::
        transacaoRecord(3, 'servico_tipos', $servico_tipo, $servico_tipo);
    }
}
