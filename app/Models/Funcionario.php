<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Funcionario extends Model
{
    use HasFactory;

    protected $table = 'funcionarios';

    protected $fillable = [
        'name',
        'data_nascimento',
        'genero_id',
        'estado_civil_id',
        'escolaridade_id',
        'nacionalidade_id',
        'naturalidade_id',
        'email',
        'father',
        'mother',
        'telephone_1',
        'telephone_2',
        'cellular_1',
        'cellular_2',
        'personal_identidade_estado_id',
        'personal_identidade_orgao_id',
        'personal_identidade_numero',
        'personal_identidade_data_emissao',
        'professional_identidade_estado_id',
        'professional_identidade_orgao_id',
        'professional_identidade_numero',
        'professional_identidade_data_emissao',
        'cpf',
        'pis',
        'pasep',
        'carteira_trabalho',
        'cep',
        'numero',
        'complemento',
        'logradouro',
        'bairro',
        'localidade',
        'uf',
        'funcao_id',
        'data_admissao',
        'data_demissao',
        'foto'
    ];

    protected $dates = [
        'data_nascimento',
        'data_admissao',
        'data_demissao',
        'personal_identidade_data_emissao',
        'professional_identidade_data_emissao'
    ];
}
