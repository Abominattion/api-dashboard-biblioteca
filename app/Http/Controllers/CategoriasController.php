<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriasController extends Controller
{
    /**
     * Lista todos as categorias
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categorias::select("id", "titulo")->orderBy("titulo", "ASC")->get();
        if ($categorias->count() == 0) {
            return response()->json(['status' => 'empty', 'message' => 'Nenhum aluno cadastrado no momento!'], 200);
        }
        return response()->json($categorias);
    }

    /**
     * Mostra uma categoria específica
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoria = Categorias::select("*")->where("id", $id)->first();
        return response()->json($categoria, 200);
    }

    /**
     * Cadastra uma nova categoria
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {

        $categoria = new Categorias();
        $categoria->titulo = $request->titulo;
        $categoria->save();

        if ($categoria->save()) {
            return response()->json([
                "icon" => "success",
                "title" => "Tudo pronto " . Auth::user()->nome . "!",
                "text" => "A categoria foi cadastrada com sucesso!",
            ], 200);
        } else {
            return response()->json([
                "icon" => "error",
                "title" => "Ops!",
                "text" => "Não foi possível cadastrar a categoria!",
            ], 404);
        }
    }

    /**
     * Atualiza a categoria
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $categoria = Categorias::find($id);
        $categoria->titulo = $request->titulo;
        $categoria->save();

        if ($categoria->save()) {
            return response()->json([
                "icon" => "success",
                "title" => "Tudo pronto " . Auth::user()->nome . "!",
                "text" => "O cadastro da categoria foi atualizado com sucesso!",
            ], 200);
        } else {
            return response()->json([
                "icon" => "error",
                "title" => "Ops!",
                "text" => "Não foi possível atualizar a categoria!",
            ], 404);
        }
    }

    /**
     * Remove a categoria da base de dados
     * 
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $categoria = Categorias::find($id);
        if ($categoria) {
            $categoria->delete();
            return response()->json([
                "icon" => "success",
                "title" => "Tudo pronto " . Auth::user()->nome . "!",
                "text" => "A categoria foi removida com sucesso!",
            ], 200);
        } else {
            return response()->json([
                "icon" => "error",
                "title" => "Ops!",
                "text" => "A categoria não foi encontrada!",
            ], 404);
        }
    }
}
