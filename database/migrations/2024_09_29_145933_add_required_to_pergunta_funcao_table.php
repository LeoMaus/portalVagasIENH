<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRequiredToPerguntaFuncaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pergunta_funcao', function (Blueprint $table) {
            $table->boolean('required')->default(false); // ou outro tipo adequado
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pergunta_funcao', function (Blueprint $table) {
            $table->dropColumn('required');
        });
    }
}
