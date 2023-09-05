<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrigadaRonda extends Model
{
    use HasFactory;

    protected $table = 'brigadas_rondas';

    protected $fillable = [
        'brigada_escala_id',
        'data',
        'hora'
    ];

    protected function setDataAttribute($value) {
        $this->attributes['data'] = \Carbon\Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }
    protected function getDataAttribute($value) {
        return \Illuminate\Support\Carbon::parse($value)->format('d/m/Y');
    }
}
