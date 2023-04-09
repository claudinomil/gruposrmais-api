<?php

namespace App\Observers;

use App\Facades\Transacoes;
use App\Models\Departamento;

class DepartamentoObserver
{
    public function created(Departamento $departamento)
    {
        //gravar transacao
        Transacoes::transacaoRecord(1, 'departamentos', $departamento, $departamento);
    }

    public function updated(Departamento $departamento)
    {
        //gravar transacao
        $beforeData = $departamento->getOriginal();
        $laterData = $departamento->getAttributes();

        Transacoes::transacaoRecord(2, 'departamentos', $beforeData, $laterData);
    }

    public function deleted(Departamento $departamento)
    {
        //gravar transacao
        Transacoes::
        transacaoRecord(3, 'departamentos', $departamento, $departamento);
    }
}
