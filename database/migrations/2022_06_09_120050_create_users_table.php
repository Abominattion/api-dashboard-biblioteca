<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nome')->default('');
			$table->string('email')->default('')->unique('email');
			$table->string('password')->default('');
			$table->string('forget')->nullable();
			$table->timestamps(6);
		});

		DB::table('users')->insert([
			'email' => 'adonay.douglas@nubbi.com.br',
			'nome' => 'Adonay Douglas',
			'password' => '$2a$12$jS2jLLtkoRILu2S5rnxmG.naMeAQFQnSNBPqwsZN0PXqcW7f/dOq.'
		]);
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
