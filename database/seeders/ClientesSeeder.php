<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientesSeeder extends Seeder
{
    public function run()
    {
        //criando
        DB::table('clientes')->insert([
            ['status' => '1', 'tipo' => '1', 'name' => 'INNOVA ADMINISTRADAORA', 'cnpj' => '', 'data_nascimento' => '2000-01-01', 'cep' => '20710130', 'numero' => '999', 'complemento' => '', 'logradouro' => 'CENTRO DE DISTRIBUIÇÃO', 'bairro' => 'SANTA CRUZ', 'localidade' => 'RIO DE JANEIRO', 'uf' => 'RJ', 'foto' => 'build/assets/images/clientes/cliente-0.png'],
        ]);
    }
}
