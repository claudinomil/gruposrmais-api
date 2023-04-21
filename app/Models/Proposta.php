<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposta extends Model
{
    use HasFactory;

    protected $table = 'propostas';

    protected $fillable = [
        'data_proposta',
        'data_proposta_extenso',
        'numero_proposta',
        'cliente_id',
        'cliente_nome',
        'cliente_logradouro',
        'cliente_bairro',
        'cliente_cidade',
        'aos_cuidados',
        'texto_acima_tabela_servico',
        'porcentagem_desconto',
        'valor_desconto',
        'valor_desconto_extenso',
        'valor_total',
        'valor_total_extenso',
        'forma_pagamento',
        'paragrafo_1',
        'paragrafo_2',
        'paragrafo_3',
        'paragrafo_4',
        'paragrafo_5',
        'paragrafo_6',
        'paragrafo_7',
        'paragrafo_8',
        'paragrafo_9',
        'paragrafo_10'
    ];
}
