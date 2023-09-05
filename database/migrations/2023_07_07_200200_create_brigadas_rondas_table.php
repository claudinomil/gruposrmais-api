<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrigadasRondasTable extends Migration
{
    public function up()
    {
        Schema::create('brigadas_rondas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('brigada_escala_id')->constrained('brigadas_escalas');
            $table->date('data');
            $table->time('hora');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('brigadas_rondas');
    }
}
