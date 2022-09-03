<?php

use App\Models\Categorias;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCategoriasTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categorias', function (Blueprint $table) {
			$table->increments('id');
			$table->string('titulo')->default('');
			$table->timestamps(6);
		});

		DB::table('categorias')->insert([
			['titulo' => 'Biografias'],
			['titulo' => 'Coleções'],
			['titulo' => 'Comportamento'],
			['titulo' => 'Contos'],
			['titulo' => 'Crítica Literária'],
			['titulo' => 'Ficção Científica'],
			['titulo' => 'Folclore'],
			['titulo' => 'Genealogia'],
			['titulo' => 'Humor'],
			['titulo' => 'Infanto juvenis'],
			['titulo' => 'Jogos'],
			['titulo' => 'Jornais'],
			['titulo' => 'Literatura Brasileira'],
			['titulo' => 'Literatura Estrangeira'],
			['titulo' => 'Livros Raros'],
			['titulo' => 'Manuscritos'],
			['titulo' => 'Poesia'],
			['titulo' => 'Outros Assuntos'],
			['titulo' => 'Administração'],
			['titulo' => 'Agricultura'],
			['titulo' => 'Antropologia'],
			['titulo' => 'Arqueologia'],
			['titulo' => 'Arquitetura'],
			['titulo' => 'Artes'],
			['titulo' => 'Astronomia'],
			['titulo' => 'Biologia'],
			['titulo' => 'Botânica'],
			['titulo' => 'Brasil'],
			['titulo' => 'Ciência Política'],
			['titulo' => 'Ciências Exatas'],
			['titulo' => 'Cinema'],
			['titulo' => 'Comunicação'],
			['titulo' => 'Contabilidade'],
			['titulo' => 'Decoração'],
			['titulo' => 'Dicionários'],
			['titulo' => 'Didáticos'],
			['titulo' => 'Direito'],
			['titulo' => 'Documentos'],
			['titulo' => 'Ecologia'],
			['titulo' => 'Economia'],
			['titulo' => 'Engenharia'],
			['titulo' => 'Enciclopédias'],
			['titulo' => 'Ensino de Idiomas'],
			['titulo' => 'Filosofia'],
			['titulo' => 'Fotografia'],
			['titulo' => 'Geografia'],
			['titulo' => 'Guerra'],
			['titulo' => 'História do Brasil'],
			['titulo' => 'História Geral'],
			['titulo' => 'Informática'],
			['titulo' => 'Linguística'],
			['titulo' => 'Medicina'],
			['titulo' => 'Moda'],
			['titulo' => 'Música'],
			['titulo' => 'Pecuária'],
			['titulo' => 'Pedagogia'],
			['titulo' => 'Pintura'],
			['titulo' => 'Psicologia'],
			['titulo' => 'Saúde'],
			['titulo' => 'Sociologia'],
			['titulo' => 'Teatro'],
			['titulo' => 'Turismo'],
			['titulo' => 'Artesanato'],
			['titulo' => 'Auto ajuda'],
			['titulo' => 'Culinária'],
			['titulo' => 'Esoterismo'],
			['titulo' => 'Esportes'],
			['titulo' => 'Hobbies'],
			['titulo' => 'Religião'],
			['titulo' => 'Sexualidade']
		]);
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('categorias');
	}
}
