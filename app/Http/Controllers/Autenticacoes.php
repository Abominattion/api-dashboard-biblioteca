<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class Autenticacoes extends Controller
{
    /**
     * Função de login
     *
     * @return \Illuminate\Http\Response
     */
    function login(Request $request)
    {
        $inputs = $request->only(['email', 'password']);
        Validator::make($inputs, $this->_rules())->validate();

        try {
            $user = User::where('email', $inputs['email'])->first();

            if (!$user || !Hash::check($inputs['password'], $user->password)) {
                return response()->json(['errors' => 'Email ou senha incorretos', 'status' => 1], 401);
            }

            $token = empty($inputs) ? auth()->login($user) : JWTAuth::customClaims(
                [
                    'data' => ['nome' => $user->nome, 'email' => $user->email]
                ]
            )->fromUser($user);

            if (!$token) {
                return response()->json(['errors' => 'Não autorizado!'], 401);
            }
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['errors' => 'Não foi possível gerar o Token'], 500);
        }
        return $this->respondeComToken($token, $user->id, $user->nome);
    }

    /**
     * Cria e retorna um array com a estrutura do token
     *
     * @param string $token jwt
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondeComToken($token, $user_id, $user_nome)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
            // 'expires_in' => auth('api')->factory()->getTTL() * 60,
            'id' => $user_id,
            'nome' => $user_nome
        ]);
    }

    /**
     * Regras de validação
     * @return array
     */
    private function _rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string',
        ];
    }
}
