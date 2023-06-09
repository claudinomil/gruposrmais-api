<?php

namespace Database\Seeders;

use App\Models\Situacao;
use App\Models\VisitaTecnicaStatus;
use Illuminate\Database\Seeder;

class VisitaTecnicaStatusSeeder extends Seeder
{
    public function run()
    {
        VisitaTecnicaStatus::create(['id' => '1', 'name' => 'AGUARDANDO VISITA']);
        VisitaTecnicaStatus::create(['id' => '2', 'name' => 'VISITA EXECUTADA']);
    }
}
