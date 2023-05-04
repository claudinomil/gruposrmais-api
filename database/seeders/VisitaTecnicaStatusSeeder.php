<?php

namespace Database\Seeders;

use App\Models\Situacao;
use App\Models\VisitaTecnicaStatus;
use Illuminate\Database\Seeder;

class VisitaTecnicaStatusSeeder extends Seeder
{
    public function run()
    {
        VisitaTecnicaStatus::create(['id' => '1', 'name' => 'PREPARAÇÃO']);
        VisitaTecnicaStatus::create(['id' => '2', 'name' => 'AGUARDANDO']);
        VisitaTecnicaStatus::create(['id' => '3', 'name' => 'EXECUTADA']);
    }
}
