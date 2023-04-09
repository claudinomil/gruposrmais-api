<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadosCivisSeeder extends Seeder
{
    public function run()
    {
        //criando Estado Civil
        DB::table('estados_civis')->insert([
            ['name' => 'Solteiro(a)'],
            ['name' => 'Casado(a)'],
            ['name' => 'Divorciado(a)'],
            ['name' => 'Viúvo(a)'],
            ['name' => 'Separado(a) judicialmente']
        ]);
    }
}
