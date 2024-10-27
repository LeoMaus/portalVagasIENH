<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTablePerguntaFuncao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //executar apenas se a tabela pergunta_funcao existir
        if (!Schema::hasTable('pergunta_funcao')) {

            //renomear a table pergunta_funcao para pergunta_cargo
            Schema::rename('pergunta_funcao', 'pergunta_cargo');
            //renomear a coluna funcao_id para cargo_id
            Schema::table('pergunta_cargo', function (Blueprint $table) {
                $table->renameColumn('funcao_id', 'cargo_id');
            });
            //remover chave estrangeira funcao_id e adicionar chave estrangeira cargo_id
            Schema::table('pergunta_cargo', function (Blueprint $table) {
                $table->dropForeign('pergunta_funcao_funcao_id_foreign');
                $table->foreign('cargo_id')->references('id')->on('cargo');
            });
            Schema::table('pergunta_cargo', function (Blueprint $table) {
                $table->dropForeign('pergunta_funcao_pergunta_id_foreign');
                $table->foreign('pergunta_id')->references('id')->on('perguntas');
            });

        }

        
  

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
