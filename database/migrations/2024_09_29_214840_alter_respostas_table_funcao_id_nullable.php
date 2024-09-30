<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterRespostasTableFuncaoIdNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::table('respostas', function (Blueprint $table) {
                $table->bigInteger('funcao_id')->unsigned()->nullable()->change();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
            Schema::table('respostas', function (Blueprint $table) {
                $table->bigInteger('funcao_id')->unsigned()->change();
            });
    }
}
