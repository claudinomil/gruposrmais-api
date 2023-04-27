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
        'cliente_id',
        'user_id'
    ];

    protected $dates = [
        'data_visita'
    ];

    public function setUserIdAttribute($value) {if ($value == '') {$this->attributes['user_id'] = Auth::user()->id;}}

    public function setDataVisitaAttribute($value) {if ($value != '') {$this->attributes['data_visita'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');}}
}
