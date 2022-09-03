<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToLocacoesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('locacoes', function(Blueprint $table)
		{
			$table->foreign('aluno', 'locacao_aluno_id')->references('id')->on('alunos')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('livro', 'locacao_livro_id')->references('id')->on('livros')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('locacoes', function(Blueprint $table)
		{
			$table->dropForeign('locacao_aluno_id');
			$table->dropForeign('locacao_livro_id');
		});
	}

}
