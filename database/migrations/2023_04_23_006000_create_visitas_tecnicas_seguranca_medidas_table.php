<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitasTecnicasSegurancaMedidasTable extends Migration
{
    public function up()
    {
        Schema::create('visitas_tecnicas_seguranca_medidas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('visita_tecnica_id')->constrained('visitas_tecnicas');

            $table->integer('pavimento');
            $table->foreignId('seguranca_medida_id')->constrained('seguranca_medidas');
            $table->string('seguranca_medida_nome');
            $table->integer('seguranca_medida_quantidade')->nullable();
            $table->text('seguranca_medida_observacoes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitas_tecnicas_seguranca_medidas');
    }
}
