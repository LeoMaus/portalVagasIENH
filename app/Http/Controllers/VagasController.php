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

        return view('vagas.create', compact('unidades_negocio', 'funcoes'));
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


        if (!$vaga) {
            return redirect()
                ->route('vaga.index')
                ->with('error', 'Vaga não encontrada.');
        }

        return view('vagas.edit', compact('vaga', 'vagaFuncoes'));
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

        return redirect()
            ->route('vaga.index')
            ->with('success', 'Vaga editada com sucesso.');
    }

    public function store(Request $request)
    {
        view('vagas.index');

        // Validação dos dados recebidos
        $request->validate([
            'titulo' => 'required|string|max:255',
            'status' => 'required|string',
            'descricao' => 'required|string',
            'unidade' => 'required|exists:unidade_negocio,id', // Verifique se a unidade existe
            'funcoes' => 'array', // As funções devem ser um array
            'funcoes.*' => 'exists:funcao,id' // Cada função deve existir na tabela de funções
        ]);

            // Criação da nova vaga
        $vaga = Vaga::create([
            'titulo' => $request->input('titulo'),
            'status' => $request->input('status'),
            'descricao' => $request->input('descricao'),
            'id_un' => $request->input('unidade')
        ]);

            // Cadastra a relação entre vaga e funções
        $funcoes = $request->input('funcoes', []); // Obtenha as funções, ou um array vazio
        $vaga->funcoes()->attach($funcoes); // Associe as funções à nova vaga


        //busca nome da unidade com base no id recebido no request
        $unidade = UnidadeNegocio::find($request->input('unidade'));




        // Busca o email no banco de dados
        $email = Email::where('template', 'abertura_vaga')->first();
        // decodifica o array de emails
        $destinatarios = json_decode($email->email);
        // Envia o email após a inclusão
        if ($request->input('status') == 'Aberta') {
        Mail::to($destinatarios)->send(new \App\Mail\NovoRegistroEmail($request->input('titulo'), $unidade->descricao, $request->input('status')));
        
        }

        return redirect()
            ->route('vaga.index')
            ->with('success', 'Vaga adicionada com sucesso.');
    }


 
}