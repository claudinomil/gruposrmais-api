<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContratacaoTiposSeeder extends Seeder
{
    public function run()
    {
        //criando
        DB::table('contratacao_tipos')->insert([
            ['name' => 'CLT'],
            ['name' => 'MEI'],
            ['name' => 'Obra Certa']
        ]);
    }
}
