<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenerosSeeder extends Seeder
{
    public function run()
    {
        //criando Genero
        DB::table('generos')->insert([
            ['name' => 'Masculino'],
            ['name' => 'Feminino']
        ]);
    }
}
