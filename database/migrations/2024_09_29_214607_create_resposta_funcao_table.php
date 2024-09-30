<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespostaFuncaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resposta_funcao', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('resposta_id');
            $table->unsignedBigInteger('funcao_id');
            $table->unsignedBigInteger('vaga_id');
            $table->foreign('resposta_id')->references('id')->on('respostas');
            $table->foreign('funcao_id')->references('id')->on('funcoes');
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
        Schema::dropIfExists('resposta_funcao');
    }
}
