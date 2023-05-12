<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('submodulos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('modulo_id')->constrained('modulos');
            $table->string('name')->unique();
            $table->string('menu_text')->unique();
            $table->string('menu_url')->unique();
            $table->string('menu_route')->unique();
            $table->string('menu_icon');
            $table->string('prefix_permissao')->unique();
            $table->string('prefix_route')->unique();
            $table->integer('mobile')->default(0); //Se tiver como 1 o submódulo vai aparecer tambem na versão Mobile
            $table->string('menu_text_mobile')->nullable();
            $table->integer('viewing_order');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('submodulos');
    }
};
