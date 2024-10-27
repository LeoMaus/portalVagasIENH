<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vaga;
use Illuminate\Support\Facades\Mail;
use App\Models\Email;
use App\Models\UnidadeNegocio;
use App\Models\Funcao;
use App\Models\VagaFuncao;
use App\Models\Area;
use App\Models\Cargo;
use Illuminate\Support\Facades\Log;


class VagasController extends Controller
{
    public function index()
    {
        $vagas = Vaga::all();

        return view('vagas.index', compact('vagas'));
    }

    public function create()
    {
        // Direcionar para página de criar vaga
        $unidades_negocio = UnidadeNegocio::all();
        $funcoes = Funcao::all();
        $setores = Area::all();
        $cargos = Cargo::all();

        return view('vagas.create', compact('unidades_negocio', 'funcoes', 'setores', 'cargos'));
    }

    public function destroy($id)
    {
        // Lógica para excluir a vaga com o ID fornecido
        $vagas = Vaga::find($id);

        if (!$vagas) {
            return redirect()
                ->route('vaga.index')
                ->with('error', 'Vaga não encontrada.');
        }

        $vagas->delete();

        return redirect()
            ->route('vaga.index')
            ->with('success', 'Vaga excluída com sucesso.');
    }

    public function edit($id)
    {
        // Lógica para editar o vaga com o ID fornecido
        $vaga = Vaga::find($id);
        $vagaFuncoes = VagaFuncao::where('vaga_id', $vaga->id)->pluck('funcao_id')->toArray();
        $unidades_negocio = UnidadeNegocio::all();
        $funcoes = Funcao::all();



        if (!$vaga) {
            return redirect()
                ->route('vaga.index')
                ->with('error', 'Vaga não encontrada.');
        }

        return view('vagas.edit', compact('vaga', 'vagaFuncoes', 'funcoes', 'unidades_negocio'));
    }

    public function update(Request $request, $id)
    {
        // Lógica para editar a vaga com o ID fornecido
        $vagas = Vaga::find($id);

        if (!$vagas) {
            return redirect()
                ->route('vaga.index')
                ->with('error', 'Vaga não encontrada.');
        }

        $vagas->titulo = $request->input('titulo');
        $vagas->id_un = $request->input('unidade');
        $vagas->status = $request->input('status');
        $vagas->save();

        $funcoes = $request->input('funcoes', []); // Obtenha as funções, ou um array vazio
        $vagas->funcoes()->sync($funcoes); // Associe as funções à nova vaga

        return redirect()
            ->route('vaga.index')
            ->with('success', 'Vaga editada com sucesso.');
    }

    public function store(Request $request)
    {
        Log::info('Início do método store', ['dadosRecebidos' => $request->all()]);
    
        // Validação dos dados recebidos
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'unidade' => 'required|exists:unidade_negocio,id',
            'setor' => 'required|exists:area,id',
            'cargo' => 'required|exists:cargo,id',
            'descricao' => 'required|string',
            'data_inicio_vigencia' => 'required|date',
            'data_termino_vigencia' => 'required|date',
            'prazo_contratacao' => 'required|date',
            'tipo_vaga' => 'required|string',
            'situacao' => 'required|string',
            'ativo' => 'required|string',
            'salario' => 'required|numeric',
            'funcoes' => 'array',
            'funcoes.*' => 'exists:funcao,id',
            'user_id' => 'required|exists:users,id',
        ]);
    
        Log::info('Validação concluída', ['dadosValidados' => $validated]);
    
        try {
            // Criação da nova vaga
            $vaga = Vaga::create([
                'titulo' => $request->input('titulo'),
                'status' => $request->input('ativo'),
                'descricao' => $request->input('descricao'),
                'id_un' => $request->input('unidade'),
                'setor_responsavel_id' => $request->input('setor'),
                'cargo_id' => $request->input('cargo'),
                'data_inicio_vigencia' => $request->input('data_inicio_vigencia'),
                'data_termino_vigencia' => $request->input('data_termino_vigencia'),
                'prazo_contratacao' => $request->input('prazo_contratacao'),
                'tipo_vaga' => $request->input('tipo_vaga'),
                'situacao_vaga' => $request->input('situacao'),
                'salario' => $request->input('salario'),
                'usuario_criacao_id' => $request->input('user_id'),
            ]);
            Log::info('Vaga criada com sucesso', ['vagaId' => $vaga->id]);
    
            // Cadastra a relação entre vaga e funções
            $funcoes = $request->input('funcoes', []);
            $vaga->funcoes()->attach($funcoes);
            Log::info('Funções associadas à vaga', ['funcoes' => $funcoes]);
    
            // Busca o nome da unidade com base no ID recebido no request
            $unidade = UnidadeNegocio::find($request->input('unidade'));
            Log::info('Unidade encontrada', ['unidade' => $unidade]);
    
            // Busca o email no banco de dados
            $email = Email::where('template', 'abertura_vaga')->first();
            $destinatarios = json_decode($email->email);
            Log::info('Destinatários de email encontrados', ['destinatarios' => $destinatarios]);
    
            // Envia o email após a inclusão
            if ($request->input('status') == 'Aberta') {
                Mail::to($destinatarios)->send(new \App\Mail\NovoRegistroEmail(
                    $request->input('titulo'),
                    $unidade->descricao,
                    $request->input('status')
                ));
                Log::info('Email enviado para destinatários', ['titulo' => $request->input('titulo'), 'status' => $request->input('status')]);
            }
    
        } catch (\Exception $e) {
            Log::error('Erro ao criar vaga ou enviar email', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()
                ->route('vaga.index')
                ->with('error', 'Erro ao adicionar vaga.');
        }
    
        return redirect()
            ->route('vaga.index')
            ->with('success', 'Vaga adicionada com sucesso.');
    }
    


 
}