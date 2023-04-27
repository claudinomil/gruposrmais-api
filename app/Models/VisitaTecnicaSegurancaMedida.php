<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class VisitaTecnicaSegurancaMedida extends Model
{
    use HasFactory;

    protected $table = 'visitas_tecnicas_seguranca_medidas';

    protected $fillable = [
        'visita_tecnica_id',
        'seguranca_medida_id'
    ];
}
