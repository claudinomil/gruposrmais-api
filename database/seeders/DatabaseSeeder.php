<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            ModulosSeeder::class,
            SubmodulosSeeder::class,
            GenerosSeeder::class,
            ContratacaoTiposSeeder::class,
            ServicoTiposSeeder::class,
            ServicosSeeder::class,
            EstadosCivisSeeder::class,
            IdentidadeOrgaosSeeder::class,
            NacionalidadesSeeder::class,
            NaturalidadesSeeder::class,
            EscolaridadesSeeder::class,
            TelefoneDddsSeeder::class,
            TelefoneDdisSeeder::class,
            FuncionariosSeeder::class,
            GruposSeeder::class,
            IconsSeeder::class,
            PermissoesSeeder::class,
            GrupoPermissoesSeeder::class,
            SituacoesSeeder::class,
            OperacoesSeeder::class,
            SistemaAcessosSeeder::class,
            EstadosSeeder::class,
            UsersSeeder::class,
            SegurancaMedidasSeeder::class,
            EdificacaoClassificacoesSeeder::class,
            IncendioRiscosSeeder::class,
            VisitaTecnicaStatusSeeder::class,
            BancosSeeder::class,
        ]);
    }
}
