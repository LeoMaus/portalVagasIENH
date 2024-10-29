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
use App\Models\Pergunta;
use App\Models\PerguntaVaga;

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
        $setores = Area::all();
        $cargos = Cargo::all();

        // Localizar vínculo na tabela pergunta_vaga de acordo com a vaga que será editada
        $perguntasVinculadas = PerguntaVaga::where('vaga_id', $vaga->id)->get();

        // Obter os IDs das perguntas vinculadas
        $idsPerguntas = $perguntasVinculadas->pluck('pergunta_id');

        // Buscar as perguntas correspondentes usando os IDs
        $perguntas = Pergunta::whereIn('id', $idsPerguntas)->get();

        if (!$vaga) {
            return redirect()
                ->route('vaga.index')
                ->with('error', 'Vaga não encontrada.');
        }

        return view('vagas.edit', compact('vaga', 'vagaFuncoes', 'funcoes', 'unidades_negocio', 'setores', 'cargos', 'perguntas'));
    }

    public function update(Request $request, $id)
    {
        // Lógica para editar a vaga com o ID fornecido
        $vaga = Vaga::find($id);

        if (!$vaga) {
            return redirect()
                ->route('vaga.index')
                ->with('error', 'Vaga não encontrada.');
        }

        // Captura os valores antigos antes da alteração
        $oldValues = [
            'titulo' => $vaga->titulo,
            'unidade' => $vaga->id_un,
            'status' => $vaga->status,
            'descricao' => $vaga->descricao,
            'setor' => $vaga->setor_responsavel_id,
            'cargo' => $vaga->cargo_id,
            'data_inicio_vigencia' => $vaga->data_inicio_vigencia,
            'data_termino_vigencia' => $vaga->data_termino_vigencia,
            'prazo_contratacao' => $vaga->prazo_contratacao,
            'tipo_vaga' => $vaga->tipo_vaga,
            'situacao_vaga' => $vaga->situacao_vaga,
            'salario' => $vaga->salario,
        ];

        // Registra as alterações a serem feitas
        $changedFields = [];

        // Atualiza os valores da vaga e verifica alterações
        foreach ($oldValues as $key => $oldValue) {
            $newValue = $request->input($key);
            if ($oldValue != $newValue) {
                $vaga->$key = $newValue; // Atualiza o valor da vaga
                $changedFields[$key] = [
                    'old' => $oldValue,
                    'new' => $newValue,
                ];
            }
        }

        // Se houver alterações, registra no log
        if (!empty($changedFields)) {
            $logEntry = [
                'data' => now()->format('Y-m-d H:i:s'),
                'usuario_id' => $request->input('user_id'), // ID do usuário que fez a alteração
                'alteracoes' => $changedFields,
            ];

            // Atualiza o campo log_alteracoes
            $vaga->log_alteracoes .= ' | ' . json_encode($logEntry);
        }

        // Salva a vaga atualizada
        $vaga->save();

        // Atualiza as funções associadas à vaga
        $funcoes = $request->input('funcoes', []); // Obtenha as funções, ou um array vazio
        $vaga->funcoes()->sync($funcoes); // Associe as funções à nova vaga

        // Atualiza a pergunta vinculada a vaga
        $data = [
            'pergunta'   => $request->input('pergunta'),
            'options'    => ($request->input('text_resp') == True ? null : $request->input('options')),
            'mult_resps' => ($request->input('text_resp') == True ? null : ($request->input('mult_resps') == True)),
        ];

        $pergunta->update($data);
        $pergunta->vagas()->sync($request->input('vagas', []));


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
            'cargos' => 'array',
            'cargos.*' => 'exists:cargo,id',
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

            // Cadastra a relação entre vaga e cargos
            $cargos = $request->input('cargos', []);
            $vaga->cargos()->attach($cargos);
            Log::info('Cargos associados à vaga', ['cargos' => $cargos]);

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

            // cadastrar pergunta vinculada a vaga
            $data = [
                'pergunta'   => $request->input('pergunta'),
                'options'    => ($request->input('text_resp') == True ? null : $request->input('options')),
                'mult_resps' => ($request->input('text_resp') == True ? null : ($request->input('mult_resps') == True)),
            ];

            $pergunta = new Pergunta($data);
            $pergunta->save();

            // Cadastra a relação entre pergunta e vaga
            $pergunta->vagas()->attach($vaga->id);
            Log::info('Pergunta associada à vaga', ['pergunta' => $pergunta]);
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



    public function pesquisaVaga(Request $request)
    {
        // Recebe todos os filtros do formulário
        $nome = $request->input('nome');
        $area = $request->input('area');
        $tipoVaga = $request->input('tipo_vaga');
        $localTrabalho = $request->input('local_trabalho');
        $quantidadeVagas = Vaga::count();

        // Carrega todas as áreas para exibir no filtro da view
        $areas = Area::all();

        // Inicia a query base para Vaga
        $query = Vaga::query();

        // Aplica filtro por nome, se fornecido
        if (!empty($nome)) {
            $query->where('titulo', 'like', '%' . $nome . '%');
            $quantidadeVagas = $query->count();
        }

        // Aplica filtro por área, se fornecido
        if (!empty($area)) {
            $query->where('setor_responsavel_id', $area);
            $quantidadeVagas = $query->count();
        }

        // Aplica filtro por tipo de vaga, se fornecido
        if (!empty($tipoVaga)) {
            $query->where('tipo_vaga', $tipoVaga);
            $quantidadeVagas = $query->count();
        }

        // // Aplica filtro por local de trabalho, se fornecido
        // if (!empty($localTrabalho)) {
        //     $query->where('local_trabalho', $localTrabalho);
        // }

        // Executa a query e obtém os resultados
        $vagas = $query->get();

        return view('home', compact('vagas', 'areas', 'quantidadeVagas'));
    }
}
