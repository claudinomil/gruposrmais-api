<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SituacoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('situacoes')->insert([
            ['name' => 'Liberado', 'bg_badge' => 'success'],
            ['name' => 'Bloqueado', 'bg_badge' => 'danger'],
        ]);
    }
}
