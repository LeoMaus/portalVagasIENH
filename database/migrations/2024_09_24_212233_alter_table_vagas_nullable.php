<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableVagasNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vagas', function (Blueprint $table) {
            // Altere o tipo da coluna 'id_un' para bigInteger, se ainda não for
            $table->bigInteger('id_un')->unsigned()->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vagas', function (Blueprint $table) {
            // Reverte para o tipo original, se necessário
            $table->bigInteger('id_un')->unsigned()->nullable(false)->change();
        });
    }
}
