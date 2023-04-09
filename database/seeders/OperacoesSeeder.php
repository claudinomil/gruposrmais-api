<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OperacoesSeeder extends Seeder
{
    public function run()
    {
        DB::table('operacoes')->insert([
            ['name' => 'Inclusão'],
            ['name' => 'Alteração'],
            ['name' => 'Exclusão'],
        ]);
    }
}
