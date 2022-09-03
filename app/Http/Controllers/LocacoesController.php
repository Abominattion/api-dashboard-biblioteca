<?php

namespace App\Http\Controllers;

use App\Models\Livros;
use App\Models\Locacoes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class LocacoesController extends Controller
{
    /**
     * Mostra todas as locações
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locacoes = Locacoes::select("*")->with('aluno', 'livro')->orderBy("id", "ASC")->get();
        if ($locacoes->count() == 0) {
            return response()->json(["message" => "Nenhuma locação ativa no momento!"], 200);
        }
        return response()->json($locacoes);
    }

    /**
     * Mostra as locações ativas
     * 
     * @return \Illuminate\Http\Response
     */
    public function ativas()
    {
        $locacoes = Locacoes::select("*")->with('aluno', 'livro')->where("status", "1")->orderBy("id", "DESC")->get();
        if ($locacoes->count() == 0) {
            return response()->json(["message" => "Nenhuma locação ativa no momento!"], 200);
        }
        return response()->json($locacoes);
    }

    /**
     * Mostra locações inativas
     * 
     * @return \Illuminate\Http\Response
     */
    public function inativas()
    {
        $locacoes = Locacoes::select("*")->with('aluno', 'livro')->where("status", "0")->orderBy("id", "DESC")->get();
        if ($locacoes->count() == 0) {
            return response()->json(["message" => "Nenhuma locação ativa no momento!"], 200);
        }
        return response()->json($locacoes);
    }

    /**
     * Mostra uma locação específica
     * 
     * @param int $id
     */
    public function show($id)
    {
        $locacoes = Locacoes::select("*")->where("id", $id)->with('aluno', 'livro')->orderBy("id", "ASC")->get();
        if ($locacoes->count() == 0) {
            return response()->json(["message" => "Nenhuma locação encontrada!"], 200);
        }
        return response()->json($locacoes);
    }

    /**
     * Cria uma nova locação
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $locacao = new Locacoes();
        $locacao->livro = $request->livro;
        $locacao->aluno = $request->aluno;
        $locacao->data_locacao = $request->data_locacao;
        $locacao->data_devolucao = $request->data_devolucao;
        $locacao->status = "1";
        $locacao->save();

        $livro = Livros::find($request->livro);
        $livro->disponivel = "Não";
        $livro->save();

        if ($locacao->save()) {
            return response()->json([
                "icon" => "success",
                "title" => "Tudo pronto " . Auth::user()->nome . "!",
                "text" => "A locação foi realizada com sucesso!",
            ], 200);
        } else {
            return response()->json([
                "icon" => "error",
                "title" => "Ops " . Auth::user()->nome . "!",
                "text" => "Não foi possível realizar a locação!",
            ], 404);
        }
    }

    /**
     * Encerra as locações	
     * 
     * @param Request $request
     * @param int $id
     */
    public function update(Request $request, $id)
    {
        $locacao = Locacoes::find($id);
        $locacao->situacao_livro = $request->status;
        if ($request->devolucao_atradasa) {
            $locacao->devolucao_atradasa = $request->devolucao_atradasa;
        }
        $locacao->status = "0";
        $locacao->save();

        $livro = Livros::find($request->livroID);
        $livro->situacao_livro = $request->status;
        $livro->disponivel = "Sim";
        $livro->save();

        if ($locacao->save()) {
            return response()->json([
                "icon" => "success",
                "title" => "Tudo pronto " . Auth::user()->nome . "!",
                "text" => "A devolução foi realizada com sucesso!",
            ], 200);
        } else {
            return response()->json([
                "icon" => "error",
                "title" => "Ops " . Auth::user()->nome . "!",
                "text" => "Não foi possível realizar a devolução!",
            ], 404);
        }
    }
}
