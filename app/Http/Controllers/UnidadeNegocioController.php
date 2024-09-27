<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\UnidadeNegocio;
use App\Models\Area;
use App\Models\User;
use Illuminate\Http\Request;

class UnidadeNegocioController extends Controller
{
    public function index()
    {
        // Buscar todas as funções do banco de dados
        $unidadeNegocios = UnidadeNegocio::all();
        
        // Retornar a view com as funções
        return view('unidadeNegocio.index', ['unidadeNegocios' => $unidadeNegocios]);
    }

    public function store(Request $request)
    {
        // Validar os dados do request
        $request->validate([
            'descricao' => 'nullable|string',
            'id_empresa' => 'nullable|string',
            'id_un_pai' => 'nullable|string',
            'id_responsavel' => 'nullable|string',
            'ativo' => 'nullable|string',
            'id_usuario_criacao' => 'nullable|string',
            'log' => 'nullable|string',
        ]);

        // Criar uma nova unidadeNegocio com os dados fornecidos
        unidadeNegocio::create($request->all());

        $unidadeNegocios = UnidadeNegocio::all();

        // Redirecionar para a lista de funções com uma mensagem de sucesso
        return redirect()->route('unidadeNegocio.index')
        ->with('status', 'Unidade de Negocio criada com sucesso!')
        ->with('unidadeNegocios', $unidadeNegocios);
    }

    // unidadeNegocio create 
    public function create()
    {   
        // buscar users com pf_pj que sejam pj
        $empresas = User::where('pf_pj', 'pj')->get();
        $users = User::where('pf_pj', 'pf')->get();
        $unidadeNegocios = UnidadeNegocio::all();


        // Retornar a view para criar uma nova unidadeNegocio
        return view('unidadeNegocio.create', compact('users', 'unidadeNegocios', 'empresas'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\unidadeNegocio $unidadeNegocio
     * @return \Illuminate\View\View
     */
    
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\unidadeNegocio $unidadeNegocio
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, unidadeNegocio $unidadeNegocio)
    {
        // Validar os dados do request
        $request->validate([
           'descricao' => 'nullable|string',
            'id_empresa' => 'nullable|string',
            'id_un_pai' => 'nullable|string',
            'id_responsavel' => 'nullable|string',
            'ativo' => 'nullable|string',
            'id_usuario_criacao' => 'nullable|string',
            'log' => 'nullable|string',
        ]);

        // Atualizar a unidadeNegocio com os dados fornecidos
        $unidadeNegocio->update($request->all());

        // Redirecionar para a lista de funções com uma mensagem de sucesso
        return redirect()->route('unidadeNegocio.index')->with('status', 'Unidade de Negocio atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\unidadeNegocio $unidadeNegocio
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(unidadeNegocio $unidadeNegocio)
    {
        // Excluir a unidadeNegocio
        $unidadeNegocio->delete();

        // Redirecionar para a lista de funções com uma mensagem de sucesso
        return redirect()->route('unidadeNegocio.index')->with('status', 'Unidade de Negocio excluída com sucesso!');
    }

    public function edit(unidadeNegocio $unidadeNegocio)
    {
        $users = User::all();

        // Retornar a view para editar a unidadeNegocio
        return view('unidadeNegocio.edit', compact('unidadeNegocio', 'users'));
    }
}
