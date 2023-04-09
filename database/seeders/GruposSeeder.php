<?php

namespace Database\Seeders;

use App\Models\Grupo;
use Illuminate\Database\Seeder;

class GruposSeeder extends Seeder
{
    public function run()
    {
        //criando Grupo
        Grupo::create(['name' => 'Administrador']);
    }
}
