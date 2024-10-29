<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVagaCargoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaga_cargo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vaga_id');
            $table->unsignedBigInteger('cargo_id');
            $table->foreign('vaga_id')->references('id')->on('vagas');
            $table->foreign('cargo_id')->references('id')->on('cargo');
            $table->unique(['vaga_id', 'cargo_id']);
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
        Schema::dropIfExists('vaga_cargo');
    }
}
