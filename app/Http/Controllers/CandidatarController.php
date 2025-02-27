<?php

namespace App\Http\Controllers;
use App\Auth;
use App\Models\Candidato;
use Illuminate\Http\Request;
use App\Models\Pergunta;
use App\Models\Vaga;
use App\Models\Resposta;
use App\Models\User;
use App\Models\CandidaturaVaga;
use App\Models\PerguntaFuncao;
use App\Models\PerguntaVaga;
use App\Models\Funcao;
use App\Models\Cargo;
use App\Models\PerguntaCargo;

class CandidatarController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($vagaId)
    {
        $user = Candidato::logged();
        $userId = auth()->user();
        $vaga = Vaga::find($vagaId);
        //array de funcões da vaga
        // $funcoes = $vaga->funcoes()->pluck('funcao.id');

        //array de cargos da vaga
        $cargos = $vaga->cargos()->pluck('cargo.id');

        // Recupere as perguntas associadas à vaga com o ID igual a $vagaId
        $perguntasVaga = Pergunta::whereHas('vagas', function ($query) use ($vagaId) {
            $query->where('vaga_id', $vagaId);
        });

        // Recupere as perguntas associadas ao cargo ao qual a vaga está associada
        $perguntasCargo = Pergunta::whereHas('cargos', function ($query) use ($vaga) {
            $query->whereIn('cargo.id', $vaga->cargos()->pluck('cargo.id'));
        });

        // Combina as duas consultas com union e obtém os resultados
        $perguntas = $perguntasVaga->union($perguntasCargo)->get();

      

        


        //verificar se o usuário já não está candidatado na vaga
        //$canditaturaExiste = Resposta::where('user_id', $userId->id)->where('vaga_id', $vaga->id);
        $candidaturaVagaExiste = CandidaturaVaga::where('user_id', $userId->id)->where('vaga_id', $vaga->id);
        if($candidaturaVagaExiste->count() > 0){
            return redirect()->route('home')->with('error', 'Você já está candidatado nesta vaga.');
        }
        else{
            return view('candidatar.index', compact('user', 'perguntas', 'vaga'));
        }
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $vaga_id = $request->input('vaga_id'); // Id da vaga
        //$perguntas = $request->input('perguntas'); // Array de IDs das perguntas
        $respostas = $request->input('respostas'); // Array de respostas do formulário

        //validar se respostas é diferente de null
        if($respostas !== null)
        {
            // Percorre as respostas
            foreach ($respostas as $perguntaId => $respostasPorPergunta) {
                // Verifica se as respostas são um array
                if (is_array($respostasPorPergunta)) {
                    // As respostas são um array
                    foreach ($respostasPorPergunta as $resposta) {
                        $respostaModel = new Resposta();
                        $respostaModel->pergunta_id = $perguntaId;
                        $respostaModel->vaga_id = $vaga_id;
                        $respostaModel->user_id = $user->id;
                        $respostaModel->resposta = $resposta;
                        $respostaModel->save();
                    }
                } else {
                    // As respostas não são um array, trata como resposta unica
                    $respostaModel = new Resposta();
                    $respostaModel->pergunta_id = $perguntaId;
                    $respostaModel->vaga_id = $vaga_id;
                    $respostaModel->user_id = $user->id;
                    $respostaModel->resposta = $respostasPorPergunta;
                    $respostaModel->save();
                }
            }
        }
        $candidaturaVaga = new CandidaturaVaga();
        $candidaturaVaga->user_id = $user->id;
        $candidaturaVaga->vaga_id = $vaga_id;
        $candidaturaVaga->transferencia_vaga = null;
        $candidaturaVaga->save();

        return redirect()->route('home')->with('success', 'Candidatura inserida com sucesso.');
    }

    
}
