<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargoFuncaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargo_funcao', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cargo_id');
            $table->unsignedBigInteger('funcao_id');
            $table->foreign('cargo_id')->references('id')->on('cargo');
            $table->foreign('funcao_id')->references('id')->on('funcao');
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
        Schema::dropIfExists('cargo_funcao');
    }
}
