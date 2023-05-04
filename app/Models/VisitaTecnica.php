<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class VisitaTecnica extends Model
{
    use HasFactory;

    protected $table = 'visitas_tecnicas';

    protected $fillable = [
        'data_visita',
        'visita_tecnica_status_id',
        'cliente_id',
        'responsavel_funcionario_id',
        'numero_pavimentos',
        'altura',
        'area_total_construida',
        'lotacao',
        'carga_incendio',
        'incendio_risco',
        'grupo',
        'ocupacao_uso',
        'divisao',
        'descricao',
        'definicao',
        'projeto_scip',
        'projeto_scip_numero',
        'laudo_exigencias',
        'laudo_exigencias_numero',
        'laudo_exigencias_data_emissao',
        'laudo_exigencias_data_vencimento',
        'certificado_aprovacao',
        'certificado_aprovacao_numero',
        'certificado_aprovacao_simplificado',
        'certificado_aprovacao_simplificado_numero',
        'certificado_aprovacao_assistido',
        'certificado_aprovacao_assistido_numero'
    ];

    protected $dates = [
        'data_visita'
    ];

    public function setDataVisitaAttribute($value) {if ($value != '') {$this->attributes['data_visita'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');}}
}
