<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableVagasFase1Salario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vagas', function (Blueprint $table) {
            // Adicionando coluna de salário
            $table->decimal('salario', 10, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Revertendo a adição da coluna de salário
        Schema::table('vagas', function (Blueprint $table) {
            $table->dropColumn('salario');
        });
    }
}
