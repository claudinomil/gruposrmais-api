<?php

namespace Database\Seeders;

use App\Models\UserConfiguracao;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $user = \App\Models\User::factory()->create([
            'id' => 1,
            'name' => 'CLAUDINO MIL HOMENS DE MORAES',
            'email' => 'claudinomoraes@yahoo.com.br',
            'password' => Hash::make('claudino1971'),
            'email_verified_at' => now(),
            'user_confirmed_at' => now(),
            'avatar' => 'build/assets/images/users/avatar-0.png',
            'created_at' => now()
        ]);

        UserConfiguracao::create([
            'user_id' => 1,
            'empresa_id' => 1,
            'grupo_id' => 1,
            'situacao_id' => 1,
            'sistema_acesso_id' => 1,
            'layout_mode' => 'layout_mode_light',
            'layout_style' => 'layout_style_vertical_scrollable'
        ]);

        $user2 = \App\Models\User::factory()->create([
            'id' => 2,
            'name' => 'MARCUS VINICIUS MACHADO DE OLIVEIRA',
            'email' => 'mvmdeoliveira@gmail.com',
            'password' => '$2y$10$Lp9xHRpq4Vu1LjDv3y6nke8ARGQvufNp3PvBVxZ8rsIRfXj1lU8vi',
            'email_verified_at' => now(),
            'user_confirmed_at' => now(),
            'avatar' => 'build/assets/images/users/avatar-0.png',
            'created_at' => now()
        ]);

        UserConfiguracao::create([
            'user_id' => 2,
            'empresa_id' => 1,
            'grupo_id' => 1,
            'situacao_id' => 1,
            'sistema_acesso_id' => 1,
            'layout_mode' => 'layout_mode_light',
            'layout_style' => 'layout_style_vertical_scrollable'
        ]);
    }
}
