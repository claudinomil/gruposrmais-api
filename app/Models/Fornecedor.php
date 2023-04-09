<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Fornecedor extends Model
{
    use HasFactory;

    protected $table = 'fornecedores';

    protected $fillable = [
        'status',
        'tipo',
        'name',
        'nome_fantasia',
        'inscricao_estadual',
        'inscricao_municipal',
        'cpf',
        'cnpj',
        'identidade_estado_id',
        'identidade_orgao_id',
        'identidade_numero',
        'identidade_data_emissao',
        'genero_id',
        'data_nascimento',
        'cep',
        'numero',
        'complemento',
        'logradouro',
        'bairro',
        'localidade',
        'uf',
        'cep_cobranca',
        'numero_cobranca',
        'complemento_cobranca',
        'logradouro_cobranca',
        'bairro_cobranca',
        'localidade_cobranca',
        'uf_cobranca',
        'banco_id',
        'agencia',
        'conta',
        'email',
        'site',
        'telefone_1',
        'telefone_2',
        'celular_1',
        'celular_2',
        'foto'
    ];

    protected $dates = [
        'data_nascimento',
        'identidade_data_emissao'
    ];
}
