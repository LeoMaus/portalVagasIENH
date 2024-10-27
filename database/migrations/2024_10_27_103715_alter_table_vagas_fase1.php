<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableVagasFase1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vagas', function (Blueprint $table) {
            $table->unsignedBigInteger('setor_responsavel_id')->nullable();
            $table->unsignedBigInteger('vaga_responsavel_id')->nullable();
            $table->unsignedBigInteger('gestor_aprovador_id')->nullable();
            $table->unsignedBigInteger('cargo_id')->nullable();
            $table->unsignedBigInteger('funcao_id')->nullable();
            $table->date('data_inicio_vigencia')->nullable();
            $table->date('data_termino_vigencia')->nullable();
            $table->string('prazo_contratacao')->nullable();
            $table->unsignedBigInteger('recrutador_responsavel_id')->nullable();
            $table->unsignedBigInteger('avaliador_responsavel_id')->nullable();
            $table->string('tipo_vaga')->nullable();
            $table->string('situacao_vaga')->nullable();
            $table->unsignedBigInteger('usuario_criacao_id')->nullable();
            $table->text('log_alteracoes')->nullable();

            // Adicionando as chaves estrangeiras
            $table->foreign('setor_responsavel_id')->references('id')->on('area');
            $table->foreign('vaga_responsavel_id')->references('id')->on('vagas');
            $table->foreign('gestor_aprovador_id')->references('id')->on('vagas');
            $table->foreign('cargo_id')->references('id')->on('cargo');
            $table->foreign('funcao_id')->references('id')->on('funcao');
            $table->foreign('recrutador_responsavel_id')->references('id')->on('vagas');
            $table->foreign('avaliador_responsavel_id')->references('id')->on('vagas');
            $table->foreign('usuario_criacao_id')->references('id')->on('users');
                
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

            $table->dropForeign(['setor_responsavel_id']);
            $table->dropForeign(['vaga_responsavel_id']);
            $table->dropForeign(['gestor_aprovador_id']);
            $table->dropForeign(['cargo_id']);
            $table->dropForeign(['funcao_id']);
            $table->dropForeign(['recrutador_responsavel_id']);
            $table->dropForeign(['avaliador_responsavel_id']);
            $table->dropForeign(['usuario_criacao_id']);

            $table->dropColumn('setor_responsavel_id');
            $table->dropColumn('vaga_responsavel_id');
            $table->dropColumn('gestor_aprovador_id');
            $table->dropColumn('cargo_id');
            $table->dropColumn('funcao_id');
            $table->dropColumn('data_inicio_vigencia');
            $table->dropColumn('data_termino_vigencia');
            $table->dropColumn('prazo_contratacao');
            $table->dropColumn('recrutador_responsavel_id');
            $table->dropColumn('avaliador_responsavel_id');
            $table->dropColumn('tipo_vaga');
            $table->dropColumn('situacao_vaga');
            $table->dropColumn('usuario_criacao_id');
            $table->dropColumn('log_alteracoes');
        });

    }
}
