<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelephoneDdd extends Model
{
    use HasFactory;

    protected $table = 'telefones_ddds';

    protected $fillable = [
        'city',
        'ddd'
    ];
}
