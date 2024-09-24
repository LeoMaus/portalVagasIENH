<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnidadeNegocioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidade_negocio', function (Blueprint $table) {
            $table->id();
            $table->string('descricao');
            $table->unsignedBigInteger('id_empresa');
            $table->unsignedBigInteger('id_un_pai');
            $table->unsignedBigInteger('id_responsavel');
            $table->foreign('id_responsavel')->references('id')->on('users');
            $table->boolean('ativo');
            $table->unsignedBigInteger('id_usuario_criacao');
            //campo para log de alterações
            $table->string('log');
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
        Schema::dropIfExists('unidade_negocio');
    }
}
