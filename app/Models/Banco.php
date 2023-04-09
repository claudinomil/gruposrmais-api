<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    use HasFactory;

    protected $table = 'bancos';

    protected $fillable = [
        'name'
    ];

    public function setServidorAttribute($value)
    {
        $this->attributes['servidor'] = mb_strtoupper($value);
    }
}