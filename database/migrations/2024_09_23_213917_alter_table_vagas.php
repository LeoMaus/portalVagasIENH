<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableVagas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //dropar a coluna unidade
        Schema::table('vagas', function (Blueprint $table) {
            $table->unsignedBigInteger('id_un');
            $table->string('descricao');
            $table->foreign('id_un')->references('id')->on('unidade_negocio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
