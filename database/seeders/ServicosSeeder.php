<?php

namespace Database\Seeders;

use App\Models\Servico;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicosSeeder extends Seeder
{
    public function run()
    {
        //criando
        Servico::create(['name' => 'RECARGA DE EXTINTOR DE INCÊNDIO DO TIPO CO2 - 6KG', 'servico_tipo_id' => '1', 'valor' => '50.00']);
        Servico::create(['name' => 'RECARGA DE EXTINTOR DE INCÊNDIO DO TIPO PQS BC - 6KG', 'servico_tipo_id' => '1', 'valor' => '42.00']);
        Servico::create(['name' => 'RECARGA DE EXTINTOR DE INCÊNDIO DO TIPO AP - 10L', 'servico_tipo_id' => '1', 'valor' => '33.00']);
        Servico::create(['name' => 'RETESTE DE MANGUEIRAS DE INCÊNDIO DO TIPO 2, DE 2 ½”', 'servico_tipo_id' => '1', 'valor' => '20.00']);
    }
}
