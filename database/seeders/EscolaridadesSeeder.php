<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EscolaridadesSeeder extends Seeder
{
    public function run()
    {
        DB::table('escolaridades')->insert([
            ['name' => 'Analfabeto'],
            ['name' => 'Até 5º Ano Incompleto'],
            ['name' => '5º Ano Completo'],
            ['name' => '6º ao 9º Ano do Fundamental'],
            ['name' => 'Fundamental Completo'],
            ['name' => 'Médio Incompleto'],
            ['name' => 'Médio Completo'],
            ['name' => 'Superior Incompleto'],
            ['name' => 'Superior Completo'],
            ['name' => 'Mestrado'],
            ['name' => 'Doutorado'],
            ['name' => 'Ignorado']
        ]);
    }
}
