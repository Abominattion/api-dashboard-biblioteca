<?php

use App\Http\Controllers\AlunosController;
use App\Http\Controllers\Autenticacoes;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\CountController;
use App\Http\Controllers\HistoricoController;
use App\Http\Controllers\LivrosController;
use App\Http\Controllers\LocacoesController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Login
Route::post('/auth/login', [Autenticacoes::class, 'login']);

Route::group(
    ['prefix' => 'v1', 'middleware' => 'auth:api'],
    function () {
    
    /**
     * Rotas de alunos
     */
    Route::get('/alunos', [AlunosController::class, 'index']);
    Route::get('/buscar-aluno/{filtro}/{busca}', [AlunosController::class, 'search']);
    Route::get('/aluno/{id}', [AlunosController::class, 'show']); 
    Route::post('/cadastrar-aluno', [AlunosController::class, 'store']);
    Route::put('/editar-aluno/{id}', [AlunosController::class, 'update']); 
    Route::post('/excluir-aluno/{id}', [AlunosController::class, 'destroy']);

    /**
     * Rotas de livros
     */
    Route::get('/livros', [LivrosController::class, 'index']);
    Route::get('/livro/{id}', [LivrosController::class, 'show']); 
    Route::post('/cadastrar-livro', [LivrosController::class, 'store']); 
    Route::put('/editar-livro/{id}', [LivrosController::class, 'update']); 
    Route::post('/excluir-livro/{id}', [LivrosController::class, 'destroy']);

    /**
     * Rotas de categorias
     */
    Route::get('/categorias', [CategoriasController::class, 'index']); 
    Route::get('/categorias/{id}', [CategoriasController::class, 'show']); 
    Route::post('/cadastrar-categoria', [CategoriasController::class, 'store']); 
    Route::put('/editar-categoria/{id}', [CategoriasController::class, 'update']); 
    Route::post('/excluir-categoria/{id}', [CategoriasController::class, 'destroy']); 
    
    /**
     * Rotas de históricos
     */
    Route::get('/historico-aluno/{id}', [HistoricoController::class, 'aluno']);
    Route::get('/historico-livro/{id}', [HistoricoController::class, 'livro']);

    /**
     * Rotas de locações
     */
    Route::get('/locacoes', [LocacoesController::class, 'index']);
    Route::get('/locacoes-ativas', [LocacoesController::class, 'ativas']);
    Route::get('/locacoes-inativas', [LocacoesController::class, 'inativas']);
    Route::get('/locacao/{id}', [LocacoesController::class, 'show']); 
    Route::post('/cadastrar-locacao', [LocacoesController::class, 'store']); 
    Route::put('/editar-locacao/{id}', [LocacoesController::class, 'update']); 

    /**
     * Rotas de usuários
     */      
    Route::get('/usuarios', [UserController::class, 'index']); 
    Route::get('/usuarios/{id}', [UserController::class, 'show']); 
    Route::post('/cadastrar-usuario', [UserController::class, 'store']);
    Route::put('/editar-usuario/{id}', [UserController::class, 'update']); 
    Route::post('/excluir-usuario/{id}', [UserController::class, 'destroy']);

    /**
     * Rotas de dados gerais, quantidade de usuarios, alunos, livros, locações
     */
    Route::get('dash-quantidades', [CountController::class, 'count']);
    Route::get('notificacoes', [CountController::class, 'notifications']);
});
