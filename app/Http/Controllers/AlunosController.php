<?php

namespace App\Http\Controllers;

use App\Models\Alunos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlunosController extends Controller
{
    /**
     * Lista todos os alunos
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alunos = Alunos::select("id", "nome", "email", "documento")
            ->orderBy("nome", "ASC")
            ->paginate(2);

        if (empty($alunos)) {
            return response()->json([
                'status' => 'empty', 
                'message' => 'Nenhum aluno cadastrado no momento!'
            ], 200);
        }

        return response()->json($alunos);
    }

    public function search($filtro, $busca)
    {
       if(!empty($busca) && !empty($filtro)) {
            $alunos = Alunos::select("id", "nome", "email", "documento")
                ->where($filtro, 'like', "%$busca%")
                ->orderBy("nome", "ASC")
                ->paginate(15);
        } 
    
        if ($alunos->total() == 0) {
            //$alunos = $this->index();
            return response()->json([
                "icon" => "info",
                "title" => "Ops!",
                "text" => "Nenhum aluno encontrado com o filtro informado!"
            ], 200);
        }

        return response()->json($alunos);
    }

    /**
     * Mostra o aluno pelo id
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aluno = Alunos::select("id", "nome", "email", "documento", "endereco", "telefone", "sexo")->where("id", $id)->first();
        return response()->json($aluno, 200);
    }

    /**
     * Cadastra um novo aluno
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $emailExistente = Alunos::where('email', $request->email)->first();
        if ($emailExistente) {
            return response()->json([
                "icon" => "info",
                "title" => "Ops!",
                "text" => "E-mail já cadastrado"
            ], 404);
        }

        $aluno = new Alunos();
        $aluno->nome = $request->nome;
        $aluno->email = $request->email;
        $aluno->documento = $request->documento;
        $aluno->endereco = $request->endereco;
        $aluno->telefone = $request->telefone;
        $aluno->sexo = $request->sexo;
        $aluno->save();

        if ($aluno->save()) {
            return response()->json([
                "icon" => "success",
                "title" => "Tudo pronto " . Auth::user()->nome . "!",
                "text" => "O aluno foi cadastrado com sucesso!",
            ], 200);
        } else {
            return response()->json([
                "icon" => "error",
                "title" => "Erro!",
                "text" => "Não foi possível cadastrar o aluno!",
            ], 404);
        }
    }

    /**
     * Atualiza os dados do aluno
     * 
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $emailExistente = Alunos::where('email', $request->email)->first();
        if ($emailExistente) {
            return response()->json([
                "icon" => "info",
                "title" => "Ops!",
                "text" => "E-mail já cadastrado"
            ], 404);
        }
        
        $aluno = Alunos::find($id);
        $aluno->nome = $request->nome;
        $aluno->email = $request->email;
        $aluno->documento = $request->documento;
        $aluno->endereco = $request->endereco;
        $aluno->telefone = $request->telefone;
        $aluno->save();

        if ($aluno->save()) {
            return response()->json([
                "icon" => "success",
                "title" => "Tudo pronto " . Auth::user()->nome . "!",
                "text" => "O cadastro do aluno foi atualizado com sucesso!",
            ], 200);
        } else {
            return response()->json([
                "icon" => "error",
                "title" => "Ops!",
                "text" => "Não foi possível atualizar o cadastro do aluno!",
            ], 404);
        }
    }

    /**
     * Excluir cadastro de aluno
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aluno = Alunos::find($id);
        $aluno->delete();
        if ($aluno->delete()) {
            return response()->json([
                "icon" => "error",
                "title" => "Ops!",
                "text" => "O aluno não foi encontrado!"
            ], 404);
        } else {
            return response()->json([
                "icon" => "success",
                "title" => "Tudo pronto " . Auth::user()->nome . "!",
                "text" => "O cadastro do aluno foi excluído com sucesso!"
            ], 200);
        }
    }
}
