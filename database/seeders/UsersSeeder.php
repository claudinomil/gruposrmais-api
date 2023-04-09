<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Criando Usuario
        $user = \App\Models\User::factory()->create([
            'name' => 'Claudino Mil Homens de Moraes',
            'email' => 'claudinomoraes@yahoo.com.br',
            'password' => Hash::make('claudino1971'),
            'email_verified_at'=>'2022-06-02 12:00:00',
            'avatar' => 'build/assets/images/users/avatar-0.png',
            'layout_mode' => 'layout_mode_light',
            'layout_style' => 'layout_style_vertical_scrollable',
            'grupo_id' => '1',
            'situacao_id' => '1',
            'created_at' => now()
        ]);
    }
}
