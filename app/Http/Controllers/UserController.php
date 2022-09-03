<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Mostra todos os usuários
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::select("id", "nome", "email")->orderBy("nome", "ASC")->get();
        return response()->json($users);
    }

    /**
     * Mostra o usuário pelo id
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::select("*")->where("id", $id)->first();
        return response()->json($user, 200);
    }

    /**
     * Cadastra um novo usuário
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->nome = $request->nome;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        if ($user->save()) {
            return response()->json([
                "icon" => "success",
                "title" => "Tudo pronto " . Auth::user()->nome . "!",
                "text" => "Usuário cadastrado com sucesso!",
            ], 200);
        } else {
            return response()->json([
                "icon" => "error",
                "title" => "Ops " . Auth::user()->nome . "!",
                "text" => "Não foi possível cadastrar o usuário!",
            ], 200);
        }
    }

    /**
     * Atualiza um usuário
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if ($request->password == $user->password) {
            $user->nome = $request->nome;
            $user->email = $request->email;
        } else {
            $user->nome = $request->nome;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
        }
        $user->save();

        if ($user->save()) {
            return response()->json([
                "icon" => "success",
                "title" => "Tudo pronto " . Auth::user()->nome . "!",
                "text" => "Usuário atualizado com sucesso!",
            ], 200);
        } else {
            return response()->json([
                "icon" => "error",
                "title" => "Ops " . Auth::user()->nome . "!",
                "text" => "Não foi possível atualizar o usuário!",
            ], 200);
        }
    }

    /**
     * Exclui um usuário
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::find($id);
        $usuario->delete();
        if ($usuario->delete()) {
            return response()->json([
                "icon" => "error",
                "title" => "Ops!",
                "text" => "O usuário não foi encontrado!",
            ], 404);
        } else {
            return response()->json([
                "icon" => "success",
                "title" => "Tudo pronto " . Auth::user()->nome . "!",
                "text" => "Usuário removido com sucesso!",
            ], 200);
        }
    }
}
