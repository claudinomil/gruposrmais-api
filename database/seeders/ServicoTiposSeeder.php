<?php

namespace Database\Seeders;

use App\Models\ServicoTipo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicoTiposSeeder extends Seeder
{
    public function run()
    {
        //criando
        ServicoTipo::create(['name' => 'MANUTENÇÃO']);
        ServicoTipo::create(['name' => 'INSTALAÇÃO']);
        ServicoTipo::create(['name' => 'BRIGADA']);
        ServicoTipo::create(['name' => 'VENDA']);
    }
}
