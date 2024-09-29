<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUnidadeNegocioNullablePai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('unidade_negocio', function (Blueprint $table) {
            // Torna a coluna 'id_un_pai' nullable
            $table->string('id_un_pai')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('unidade_negocio', function (Blueprint $table) {
            // Reverte a coluna 'id_un_pai' para ser not nullable
            $table->string('id_un_pai')->nullable(false)->change();
        });
    }
}
