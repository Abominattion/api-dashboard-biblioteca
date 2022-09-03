<?php

namespace App\Http\Controllers;

use App\Models\Livros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LivrosController extends Controller
{
    /**
     * Mostra todos os livros
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $livros = Livros::select("*")->with('categoria')->orderBy("titulo", "ASC")->get();
        if ($livros->count() == 0) {
            return response()->json(['status' => 'empty', "message" => "Nenhum livro cadastrado no momento!"], 200);
        }
        return response()->json($livros);
    }

    /**
     * Mostra o livro pelo id
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $livro = Livros::select("*")->where("id", $id)->first();
        return response()->json($livro, 200);
    }

    /**
     * Cadastra um novo livro
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        $livro = new Livros();
        $livro->categoria = $request->categoria;
        $livro->isbn = $request->isbn;
        $livro->titulo = $request->titulo;
        $livro->autor = $request->autor;
        $livro->editora = $request->editora;
        $livro->ano = $request->ano;
        $livro->save();

        if ($livro->save()) {
            return response()->json([
                "icon" => "success",
                "title" => "Tudo pronto " . Auth::user()->nome . "!",
                "text" => "O livro foi cadastrado com sucesso!",
            ], 200);
        } else {
            return response()->json([
                "icon" => "error",
                "title" => "Ops!",
                "text" => "Ocorreu um erro ao cadastrar o livro!"
            ], 404);
        }
    }

    /**
     * Atualiza um livro
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     */
    public function update(Request $request, $id)
    {

        $livro = Livros::find($id);
        $livro->categoria = $request->categoria;
        $livro->isbn = $request->isbn;
        $livro->titulo = $request->titulo;
        $livro->autor = $request->autor;
        $livro->editora = $request->editora;
        $livro->ano = $request->ano;
        $livro->save();

        if ($livro->save()) {
            return response()->json([
                "icon" => "success",
                "title" => "Tudo pronto " . Auth::user()->nome . "!",
                "text" => "O livro foi atualizado com sucesso!",
            ], 200);
        } else {
            return response()->json([
                "icon" => "error",
                "title" => "Ops!",
                "text" => "Ocorreu um erro ao atualizar o livro!"
            ], 404);
        }
    }

    /**
     * Remove um livro
     * 
     * @param int $id
     */
    public function destroy($id)
    {
        $livro = Livros::find($id);
        $livro->delete();

        if ($livro->delete()) {
            return response()->json([
                "icon" => "error",
                "title" => "Ops!",
                "text" => "Ocorreu um erro ao excluir o livro!"
            ], 404);
        } else {
            return response()->json([
                "icon" => "success",
                "title" => "Tudo pronto " . Auth::user()->nome . "!",
                "text" => "O livro foi excluído com sucesso!",
            ], 200);
        }
    }
}
