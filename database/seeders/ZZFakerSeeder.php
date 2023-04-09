<?php

namespace Database\Seeders;

use App\Models\Genero;
use App\Models\Grupo;
use App\Models\EstadoCivil;
use App\Models\Nacionalidade;
use App\Models\Funcao;
use App\Models\Situacao;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ZZFakerSeeder extends Seeder
{
    public function run()
    {
        //Fake pt_BR
        $faker = \Faker\Factory::create('pt_BR');

        //Grupos
        DB::table('grupos')->insert([
            'name' => 'Usuários'
        ]);

        DB::table('grupos')->insert([
            'name' => 'Administrador'
        ]);

        //Funcoes
        DB::table('funcoes')->insert([
            'name' => 'Gerente'
        ]);

        DB::table('funcoes')->insert([
            'name' => 'Supervisor'
        ]);

        DB::table('funcoes')->insert([
            'name' => 'Brigadista'
        ]);

        //Users
        for ($i=0; $i<50; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => Hash::make('11111111'),
                'email_verified_at'=>'2022-06-02 12:00:00',
                'avatar' => 'build/assets/images/users/avatar-0.png',
                'layout_mode' => 'layout_mode_light',
                'layout_style' => 'layout_style_vertical_scrollable',
                'grupo_id' => Grupo::all()->random()->id,
                'situacao_id' => Situacao::all()->random()->id,
                'created_at' => now()
            ]);
        }

        //Funcionarios
        for ($i=0; $i<150; $i++) {
            $cpf = $faker->cpf;
            $cpf = str_replace('.', '', $cpf);
            $cpf = str_replace('.', '', $cpf);
            $cpf = str_replace('.', '', $cpf);
            $cpf = str_replace('-', '', $cpf);

            DB::table('funcionarios')->insert([
                'name' => $faker->name,
                'data_nascimento' => $faker->date,
                'funcao_id' => Funcao::all()->random()->id,
                'genero_id' => Genero::all()->random()->id,
                'estado_civil_id' => EstadoCivil::all()->random()->id,
                'nacionalidade_id' => Nacionalidade::all()->random()->id,
                'email' => $faker->email,
                'cpf' => $cpf,
                'data_admissao' => $faker->date
            ]);
        }

        //Clientes
        for ($i=0; $i<150; $i++) {
            if ($i <= 27) {
                $status = 1;
                $tipo = 1;

                $cpf = $faker->cpf;
                $cpf = str_replace('.', '', $cpf);
                $cpf = str_replace('.', '', $cpf);
                $cpf = str_replace('.', '', $cpf);
                $cpf = str_replace('-', '', $cpf);

                DB::table('clientes')->insert([
                    'name' => $faker->name,
                    'status' => $status,
                    'tipo' => $tipo,
                    'data_nascimento' => $faker->date,
                    'email' => $faker->email,
                    'cpf' => $cpf,
                    'genero_id' => Genero::all()->random()->id
                ]);
            }

            if ($i <= 97) {
                $status = 1;
                $tipo = 2;

                $cnpj = $faker->cnpj;
                $cnpj = str_replace('.', '', $cnpj);
                $cnpj = str_replace('.', '', $cnpj);
                $cnpj = str_replace('.', '', $cnpj);
                $cnpj = str_replace('-', '', $cnpj);

                DB::table('clientes')->insert([
                    'name' => $faker->name,
                    'status' => $status,
                    'tipo' => $tipo,
                    'data_nascimento' => $faker->date,
                    'email' => $faker->email,
                    'cnpj' => $cnpj
                ]);
            }

            if ($i <= 127) {
                $status = 2;
                $tipo = 1;

                $cpf = $faker->cpf;
                $cpf = str_replace('.', '', $cpf);
                $cpf = str_replace('.', '', $cpf);
                $cpf = str_replace('.', '', $cpf);
                $cpf = str_replace('-', '', $cpf);

                DB::table('clientes')->insert([
                    'name' => $faker->name,
                    'status' => $status,
                    'tipo' => $tipo,
                    'data_nascimento' => $faker->date,
                    'email' => $faker->email,
                    'cpf' => $cpf,
                    'genero_id' => Genero::all()->random()->id
                ]);
            }

            if ($i <= 150) {
                $status = 2;
                $tipo = 2;

                $cnpj = $faker->cnpj;
                $cnpj = str_replace('.', '', $cnpj);
                $cnpj = str_replace('.', '', $cnpj);
                $cnpj = str_replace('.', '', $cnpj);
                $cnpj = str_replace('-', '', $cnpj);

                DB::table('clientes')->insert([
                    'name' => $faker->name,
                    'status' => $status,
                    'tipo' => $tipo,
                    'data_nascimento' => $faker->date,
                    'email' => $faker->email,
                    'cnpj' => $cnpj
                ]);
            }
        }
    }
}
