<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserArea;
use App\Models\Estado;
use App\Models\Cidade;
use App\Models\DadosPessoais;
use App\Models\Contato;
use App\Models\Endereco;
use App\Http\Requests\DadoPessoalRequest;
use App\Models\Curriculo;
use App\Models\Formacao;

class BancoCurriculosController extends Controller
{
    public function index()
    {

        $area = Area::all();
        $user = User::all();
        $userArea = UserArea::all();

        return view('bancoCurriculos.index', ['userArea' => $userArea]);
    }


    public function profile($id_user) {
        $user = User::with(['dadosPessoais', 'dadosPessoais.contato', 'dadosPessoais.endereco'])->find($id_user);
    
        if (!$user) {
            return redirect()->back()->with('error', 'Usuário não encontrado.');
        }
    
        // Carregar as formações, sem o escopo global
        $formacao = Formacao::withoutGlobalScope('current_user')->where('user_id', $user->id)->get();
    
        // Debug para verificar as formações
    
        // Carregar o curriculo do usuário
        $curriculo = Curriculo::where('user_id', $user->id)->first();
    
        // Retorna os estados para o select
        $estados = Estado::all();
    
        // Obtém a cidade associada
        $cidade = $user->dadosPessoais && $user->dadosPessoais->endereco
                  ? Cidade::find($user->dadosPessoais->endereco->cidade_id)
                  : null;
    
        return view('bancoCurriculos.profile', compact('user', 'estados', 'cidade', 'curriculo', 'formacao'));
    }
    
    
}
