<?php

namespace App\Http\Controllers;

use App\Models\Alunos;
use App\Models\Categorias;
use App\Models\Livros;
use App\Models\Locacoes;
use App\Models\User;
use Illuminate\Http\Request;

class CountController extends Controller
{
    /**
     * Mostra o números gerais do sistema
     *
     * @return \Illuminate\Http\Response
     */
    public function count()
    {
        return response()->json([
            'alunos' => Alunos::count(),
            'alunos_masculinos' => Alunos::where("sexo", "M")->count(),
            'alunos_femininos' => Alunos::where("sexo", "F")->count(),
            'categorias' => Categorias::count(),
            'usuarios' => User::count(),
            'livros' => Livros::count(),
            'livros_disponiveis' => Livros::where("disponivel", "Sim")->count(),
            'livros_locados' => Livros::where("disponivel", "Não")->count(),
            'locacoes_ativas' => Locacoes::where("status", 1)->count(),
            'todas_locacoes' => Locacoes::count(),
        ]);
    }

    /**
     * Mostra o número de locações atrasadas
     *
     * @return \Illuminate\Http\Response
     */
    public function notifications()
    {
        $locacoesAtrasadas = Locacoes::where("status", 1)->where("data_locacao", "<", date("Y-m-d"))->count();
        
        if($locacoesAtrasadas == 1) {
            $text = "Existe " . $locacoesAtrasadas . " locação atrasada";
        } else {
            $text = "Existem " . $locacoesAtrasadas . " locações atrasadas";
        }

        if ($locacoesAtrasadas > 0) {
            $retorno = [
                "duration" => "none",
                "color" => "primary",
                "position" => "null",
                "icon" => "<i class='bx bxs-user-pin' ></i>",
                "title" => "Locação atrasada:",
                "text" => $text
            ];  
        }

        return response()->json($retorno);
    }
}
