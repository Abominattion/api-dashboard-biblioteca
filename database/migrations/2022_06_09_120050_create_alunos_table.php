<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlunosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('alunos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nome')->default('');
			$table->string('email')->default('');
			$table->string('documento')->default('');
			$table->string('endereco')->default('');
			$table->string('telefone')->default('');
			$table->string('sexo', 1)->default('M')->comment('M, F');
			$table->date('data_nascimento')->nullable();
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
		Schema::drop('alunos');
	}

}
