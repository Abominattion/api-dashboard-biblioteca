<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivrosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('livros', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('categoria')->unsigned()->default(0)->index('categoria_id');
			$table->string('isbn')->default('');
			$table->string('titulo')->default('');
			$table->string('autor')->default('');
			$table->string('editora')->default('');
			$table->string('ano', 10)->default('');
			$table->string('disponivel', 3)->default('Sim')->comment('Sim, Não');
			$table->string('situacao_livro', 20)->default('Ok')->comment('Ok, Danificado, Destruído');
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
		Schema::drop('livros');
	}

}
