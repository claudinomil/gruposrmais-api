<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transacao extends Model
{
    use HasFactory;

    protected $table = 'transacoes';

    protected $fillable = [
        'empresa_id',
        'date',
        'time',
        'user_id',
        'operacao_id',
        'submodulo_id',
        'dados'
    ];
}
