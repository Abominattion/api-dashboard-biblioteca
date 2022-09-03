<?php

namespace App\Http\Controllers;

use App\Models\Locacoes;
use Illuminate\Http\Request;

class HistoricoController extends Controller
{
    /**
     * Mostra o histórico de locações dos alunos
     *
     * @return \Illuminate\Http\Response
     */
    public function aluno($id)
    {
        $historico = Locacoes::select("*")->with('aluno', 'livro')->where("aluno", $id)->get();
        if ($historico->count() == 0) {
            return response()->json(["message" => "Histórico do aluno está vazio."], 200);
        }
        return response()->json($historico);
    }
    
    /**
     * Mostra o histórico de locações dos livros
     *
     * @return \Illuminate\Http\Response
     */
    public function livro($id)
    {
        $historico = Locacoes::select("*")->with('aluno', 'livro')->where("livro", $id)->get();
        if ($historico->count() == 0) {
            return response()->json(["message" => "Histórico do aluno está vazio."], 200);
        }
        return response()->json($historico);
    }
}
