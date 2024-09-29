<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableFuncaoChangeResponsabilidades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('funcao', function (Blueprint $table) {
            #torna a coluna 'responsabilidades' longtext
            $table->longText('responsabilidades')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('funcao', function (Blueprint $table) {
            #reverte a coluna 'responsabilidades' para ser text
            $table->text('responsabilidades')->change();
        });
    }
}
