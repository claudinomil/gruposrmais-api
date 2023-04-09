<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modulos')->insert([
            ['id' => '1', 'name' => 'Administrador', 'menu_text' => 'Administrador', 'menu_url' => 'administrador', 'menu_route' => 'administrador', 'menu_icon' => 'fa fa-box', 'viewing_order' => 9999],
            ['id' => '2', 'name' => 'Home', 'menu_text' => 'Home', 'menu_url' => 'home', 'menu_route' => 'home', 'menu_icon' => 'fa fa-home', 'viewing_order' => 10],
	 		['id' => '3', 'name' => 'Sistema', 'menu_text' => 'Sistema', 'menu_url' => 'sistema', 'menu_route' => 'sistema', 'menu_icon' => 'fa fa-sitemap', 'viewing_order' => 8888],
            ['id' => '4', 'name' => 'Relatórios', 'menu_text' => 'Relatórios', 'menu_url' => 'relatorios', 'menu_route' => 'relatorios', 'menu_icon' => 'fa fa-print', 'viewing_order' => 7777],
            ['id' => '5', 'name' => 'Auxiliares', 'menu_text' => 'Auxiliares', 'menu_url' => 'auxiliares', 'menu_route' => 'auxiliares', 'menu_icon' => 'fa fa-list', 'viewing_order' => 20],
        ]);


    }
}
