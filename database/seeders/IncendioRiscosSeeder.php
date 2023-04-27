<?php

namespace Database\Seeders;

use App\Models\IncendioRiscos;
use Illuminate\Database\Seeder;

class IncendioRiscosSeeder extends Seeder
{
    public function run()
    {
        IncendioRiscos::create(['name' => 'Pequeno']); //1
        IncendioRiscos::create(['name' => 'Médio 1']); //2
        IncendioRiscos::create(['name' => 'Médio 2']); //3
        IncendioRiscos::create(['name' => 'Grande']); //4
    }
}
