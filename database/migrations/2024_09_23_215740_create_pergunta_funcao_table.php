<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerguntaFuncaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pergunta_funcao', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('funcao_id');
            $table->unsignedBigInteger('pergunta_id');
            $table->foreign('funcao_id')->references('id')->on('funcao');
            $table->foreign('pergunta_id')->references('id')->on('perguntas');
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
        Schema::dropIfExists('pergunta_funcao');
    }
}
