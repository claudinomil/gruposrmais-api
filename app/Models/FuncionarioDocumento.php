<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuncionarioDocumento extends Model
{
    use HasFactory;

    protected $table = 'funcionarios_documentos';

    protected $fillable = [
        'funcionario_id',
        'name',
        'descricao',
        'caminho'
    ];
}
