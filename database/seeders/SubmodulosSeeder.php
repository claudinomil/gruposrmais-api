<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubmodulosSeeder extends Seeder
{
    public function run()
    {
        DB::table('submodulos')->insert([
            ['id' => '1', 'modulo_id' => '1', 'name' => 'Módulos', 'menu_text' => 'Módulos', 'menu_url' => 'modulos', 'menu_route' => 'modulos', 'menu_icon' => 'fas fa-angle-right', 'prefix_permissao' => 'modulos', 'prefix_route' => 'modulos', 'viewing_order' => 5],
            ['id' => '2', 'modulo_id' => '1', 'name' => 'Submódulos', 'menu_text' => 'Submódulos', 'menu_url' => 'submodulos', 'menu_route' => 'submodulos', 'menu_icon' => 'fas fa-angle-right', 'prefix_permissao' => 'submodulos', 'prefix_route' => 'submodulos', 'viewing_order' => 10],
            ['id' => '3', 'modulo_id' => '2', 'name' => 'Home', 'menu_text' => 'Home', 'menu_url' => 'home', 'menu_route' => 'home', 'menu_icon' => 'fas fa-angle-right', 'prefix_permissao' => 'home', 'prefix_route' => 'home', 'viewing_order' => 0],
 	        ['id' => '4', 'modulo_id' => '2', 'name' => 'Grupos', 'menu_text' => 'Grupos', 'menu_url' => 'grupos', 'menu_route' => 'grupos', 'menu_icon' => 'fas fa-angle-right', 'prefix_permissao' => 'grupos', 'prefix_route' => 'grupos', 'viewing_order' => 15],
            ['id' => '5', 'modulo_id' => '2', 'name' => 'Usuários', 'menu_text' => 'Usuários', 'menu_url' => 'users', 'menu_route' => 'users', 'menu_icon' => 'fas fa-angle-right', 'prefix_permissao' => 'users', 'prefix_route' => 'users', 'viewing_order' => 20],
            ['id' => '6', 'modulo_id' => '3', 'name' => 'Customização', 'menu_text' => 'Customização', 'menu_url' => 'customizes', 'menu_route' => 'customizes', 'menu_icon' => 'fas fa-angle-right', 'prefix_permissao' => 'customizes', 'prefix_route' => 'customizes', 'viewing_order' => 0],
            ['id' => '7', 'modulo_id' => '3', 'name' => 'Notificações', 'menu_text' => 'Notificações', 'menu_url' => 'notificacoes', 'menu_route' => 'notificacoes', 'menu_icon' => 'fas fa-angle-right', 'prefix_permissao' => 'notificacoes', 'prefix_route' => 'notificacoes', 'viewing_order' => 25],
            ['id' => '8', 'modulo_id' => '2', 'name' => 'Log de Transações', 'menu_text' => 'Log de Transações', 'menu_url' => 'transacoes', 'menu_route' => 'transacoes', 'menu_icon' => 'fas fa-angle-right', 'prefix_permissao' => 'transacoes', 'prefix_route' => 'transacoes', 'viewing_order' => 30],
            ['id' => '9', 'modulo_id' => '1', 'name' => 'Ferramentas', 'menu_text' => 'Ferramentas', 'menu_url' => 'ferramentas', 'menu_route' => 'ferramentas', 'menu_icon' => 'fas fa-angle-right', 'prefix_permissao' => 'ferramentas', 'prefix_route' => 'ferramentas', 'viewing_order' => 35],
            ['id' => '10', 'modulo_id' => '5', 'name' => 'Bancos', 'menu_text' => 'Bancos', 'menu_url' => 'bancos', 'menu_route' => 'bancos', 'menu_icon' => 'fas fa-angle-right', 'prefix_permissao' => 'bancos', 'prefix_route' => 'bancos', 'viewing_order' => 75],
            ['id' => '11', 'modulo_id' => '5', 'name' => 'Departamentos', 'menu_text' => 'Departamentos', 'menu_url' => 'departamentos', 'menu_route' => 'departamentos', 'menu_icon' => 'fas fa-angle-right', 'prefix_permissao' => 'departamentos', 'prefix_route' => 'departamentos', 'viewing_order' => 45],
            ['id' => '12', 'modulo_id' => '5', 'name' => 'Estados Civis', 'menu_text' => 'Estados Civis', 'menu_url' => 'estados_civis', 'menu_route' => 'estados_civis', 'menu_icon' => 'fas fa-angle-right', 'prefix_permissao' => 'estados_civis', 'prefix_route' => 'estados_civis', 'viewing_order' => 50],
            ['id' => '13', 'modulo_id' => '5', 'name' => 'Nacionalidades', 'menu_text' => 'Nacionalidades', 'menu_url' => 'nacionalidades', 'menu_route' => 'nacionalidades', 'menu_icon' => 'fas fa-angle-right', 'prefix_permissao' => 'nacionalidades', 'prefix_route' => 'nacionalidades', 'viewing_order' => 55],
            ['id' => '14', 'modulo_id' => '5', 'name' => 'Escolaridades', 'menu_text' => 'Escolaridades', 'menu_url' => 'escolaridades', 'menu_route' => 'escolaridades', 'menu_icon' => 'fas fa-angle-right', 'prefix_permissao' => 'escolaridades', 'prefix_route' => 'escolaridades', 'viewing_order' => 60],
            ['id' => '15', 'modulo_id' => '5', 'name' => 'Naturalidades', 'menu_text' => 'Naturalidades', 'menu_url' => 'naturalidades', 'menu_route' => 'naturalidades', 'menu_icon' => 'fas fa-angle-right', 'prefix_permissao' => 'naturalidades', 'prefix_route' => 'naturalidades', 'viewing_order' => 65],
            ['id' => '16', 'modulo_id' => '5', 'name' => 'Gêneros', 'menu_text' => 'Gêneros', 'menu_url' => 'generos', 'menu_route' => 'generos', 'menu_icon' => 'fas fa-angle-right', 'prefix_permissao' => 'generos', 'prefix_route' => 'generos', 'viewing_order' => 70],
            ['id' => '17', 'modulo_id' => '5', 'name' => 'Funções', 'menu_text' => 'Funções', 'menu_url' => 'funcoes', 'menu_route' => 'funcoes', 'menu_icon' => 'fas fa-angle-right', 'prefix_permissao' => 'funcoes', 'prefix_route' => 'funcoes', 'viewing_order' => 40],
            ['id' => '18', 'modulo_id' => '2', 'name' => 'Funcionários', 'menu_text' => 'Funcionários', 'menu_url' => 'funcionarios', 'menu_route' => 'funcionarios', 'menu_icon' => 'fas fa-angle-right', 'prefix_permissao' => 'funcionarios', 'prefix_route' => 'funcionarios', 'viewing_order' => 40],
            ['id' => '19', 'modulo_id' => '5', 'name' => 'Órgãos Identidades', 'menu_text' => 'Órgãos Identidades', 'menu_url' => 'identidade_orgaos', 'menu_route' => 'identidade_orgaos', 'menu_icon' => 'fas fa-angle-right', 'prefix_permissao' => 'identidade_orgaos', 'prefix_route' => 'identidade_orgaos', 'viewing_order' => 80],
            ['id' => '20', 'modulo_id' => '2', 'name' => 'Clientes', 'menu_text' => 'Clientes', 'menu_url' => 'clientes', 'menu_route' => 'clientes', 'menu_icon' => 'fas fa-angle-right', 'prefix_permissao' => 'clientes', 'prefix_route' => 'clientes', 'viewing_order' => 50],
            ['id' => '21', 'modulo_id' => '2', 'name' => 'Dashboards', 'menu_text' => 'Dashboards', 'menu_url' => 'dashboards', 'menu_route' => 'dashboards', 'menu_icon' => 'fas fa-angle-right', 'prefix_permissao' => 'dashboards', 'prefix_route' => 'dashboards', 'viewing_order' => 10],
            ['id' => '22', 'modulo_id' => '2', 'name' => 'Fornecedores', 'menu_text' => 'Fornecedores', 'menu_url' => 'fornecedores', 'menu_route' => 'fornecedores', 'menu_icon' => 'fas fa-angle-right', 'prefix_permissao' => 'fornecedores', 'prefix_route' => 'fornecedores', 'viewing_order' => 60],
            ['id' => '23', 'modulo_id' => '2', 'name' => 'Usuários Perfil', 'menu_text' => 'Usuários Perfil', 'menu_url' => 'users_perfil', 'menu_route' => 'users_perfil', 'menu_icon' => 'fas fa-angle-right', 'prefix_permissao' => 'users_perfil', 'prefix_route' => 'users_perfil', 'viewing_order' => 0],
            ['id' => '24', 'modulo_id' => '2', 'name' => 'Serviço Tipos', 'menu_text' => 'Serviço Tipos', 'menu_url' => 'servico_tipos', 'menu_route' => 'servico_tipos', 'menu_icon' => 'fas fa-angle-right', 'prefix_permissao' => 'servico_tipos', 'prefix_route' => 'servico_tipos', 'viewing_order' => 70],
            ['id' => '25', 'modulo_id' => '2', 'name' => 'Serviços', 'menu_text' => 'Serviços', 'menu_url' => 'servicos', 'menu_route' => 'servicos', 'menu_icon' => 'fas fa-angle-right', 'prefix_permissao' => 'servicos', 'prefix_route' => 'servicos', 'viewing_order' => 80],
            ['id' => '26', 'modulo_id' => '2', 'name' => 'Propostas', 'menu_text' => 'Propostas', 'menu_url' => 'propostas', 'menu_route' => 'propostas', 'menu_icon' => 'fas fa-angle-right', 'prefix_permissao' => 'propostas', 'prefix_route' => 'propostas', 'viewing_order' => 90],
        ]);
    }
}
