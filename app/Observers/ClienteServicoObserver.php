<?php

namespace App\Observers;

use App\Facades\Transacoes;
use App\Models\ClienteServico;

class ClienteServicoObserver
{
    public function created(ClienteServico $cliente_servico)
    {
        //gravar transacao
        Transacoes::transacaoRecord(1, 1, 'clientes_servicos', $cliente_servico, $cliente_servico);
    }

    public function updated(ClienteServico $cliente_servico)
    {
        //gravar transacao
        $beforeData = $cliente_servico->getOriginal();
        $laterData = $cliente_servico->getAttributes();

        Transacoes::transacaoRecord(1, 2, 'clientes_servicos', $beforeData, $laterData);
    }

    public function deleted(ClienteServico $cliente_servico)
    {
        //gravar transacao
        Transacoes::transacaoRecord(1, 3, 'clientes_servicos', $cliente_servico, $cliente_servico);
    }
}
