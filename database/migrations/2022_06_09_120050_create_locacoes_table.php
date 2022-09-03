<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateLocacoesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('locacoes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('aluno')->unsigned()->default(0)->index('locacao_aluno_id');
			$table->integer('livro')->unsigned()->default(0)->index('locacao_livro_id');
			$table->string('situacao_livro', 20)->default('Ok')->comment('Ok, Danificado');
			$table->integer('status')->default(1);
			$table->timestamp('data_locacao')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('data_devolucao')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamps(6);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('locacoes');
	}

}
