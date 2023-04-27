<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitasTecnicasTable extends Migration
{
    public function up()
    {
        Schema::create('visitas_tecnicas', function (Blueprint $table) {
            $table->id();
            $table->date('data_visita');
            $table->foreignId('cliente_id')->constrained('clientes');
            $table->foreignId('user_id')->constrained('users');

            $table->integer('laudo_exigencias');
            $table->string('laudo_exigencias_numero');
            $table->date('laudo_exigencias_data_emissao');
            $table->date('laudo_exigencias_data_vencimento');
            $table->integer('certificado_aprovacao');
            $table->string('certificado_aprovacao_numero');
            $table->integer('numero_pavimentos');
            $table->decimal('altura');
            $table->decimal('area_total_construida');
            $table->integer('lotacao');
            $table->integer('carga_incendio');
            $table->foreignId('incendio_risco_id')->constrained('incendio_riscos');
            $table->foreignId('edificacao_classificacao_id')->constrained('edificacao_classificacoes');

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
        Schema::dropIfExists('visitas_tecnicas');
    }
}
