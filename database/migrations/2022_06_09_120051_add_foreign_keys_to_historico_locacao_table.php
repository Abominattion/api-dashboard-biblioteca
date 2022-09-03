<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToHistoricoLocacaoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('historico_locacao', function(Blueprint $table)
		{
			$table->foreign('aluno', 'aluno_id')->references('id')->on('alunos')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('livro', 'livro_id')->references('id')->on('livros')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('historico_locacao', function(Blueprint $table)
		{
			$table->dropForeign('aluno_id');
			$table->dropForeign('livro_id');
		});
	}

}
