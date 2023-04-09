<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicoTiposSeeder extends Seeder
{
    public function run()
    {
        //criando
        DB::table('servico_tipos')->insert([
            ['name' => 'MANUTENÇÃO'],
            ['name' => 'INSTALAÇÃO'],
            ['name' => 'BRIGADA'],
            ['name' => 'VENDA']
        ]);
    }
}
