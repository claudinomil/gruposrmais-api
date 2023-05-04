<?php

namespace Database\Seeders;

use App\Models\Funcionario;
use Illuminate\Database\Seeder;

class FuncionariosSeeder extends Seeder
{
    public function run()
    {
        Funcionario::create([
            'name' => 'MARCUS VINICIUS MACHADO DE OLIVEIRA',
            'data_nascimento' => '21/06/1972',
            'contratacao_tipo_id' => 1,
            'genero_id' => 1,
            'cpf' => '02382468769',
            'foto' => 'build/assets/images/funcionarios/funcionario-0.png',
            'created_at' => now()
        ]);
    }
}
