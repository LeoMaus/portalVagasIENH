<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserArea;

class AreaController extends Controller
{
    public function index()
    {
        // Buscar todas as funções do banco de dados
        $areas = Area::all();
        
        // Retornar a view com as funções
        return view('area.index', ['areas' => $areas]);
    }

    public function store(Request $request)
    {
        // Validar os dados do request
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        // Criar uma nova Area com os dados fornecidos
        Area::create($request->all());

        // Redirecionar para a lista de funções com uma mensagem de sucesso
        return redirect()->route('area.index')->with('status', 'Area criada com sucesso!');
    }

    // area create 
    public function create()
    {
        // Retornar a view para criar uma nova Area
        return view('area.create');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\area $area
     * @return \Illuminate\View\View
     */
    
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\area $area
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, area $area)
    {
        // Validar os dados do request
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        // Atualizar a Area com os dados fornecidos
        $area->update($request->all());

        // Redirecionar para a lista de funções com uma mensagem de sucesso
        return redirect()->route('area.index')->with('status', 'Area atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\area $area
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(area $area)
    {
        // Excluir a Area
        $area->delete();

        // Redirecionar para a lista de funções com uma mensagem de sucesso
        return redirect()->route('area.index')->with('status', 'Area excluída com sucesso!');
    }

    public function edit(area $area)
    {
        // Retornar a view para editar a Area
        return view('area.edit', compact('area'));
    }

    public function interesseArea(Request $request)
    {

        // Validar os dados do request
        $request->validate([
            'area_id' => 'required|integer',
            'user_id' => 'required|integer',
        ]);

        //consultar se dados pessoais do usuário já foram preenchidos
        $user = User::find($request->user_id);
        
        //valida se existe ao menos 1 formação
        $formacao = $user->formacao()->count();
        //valida se existe ao menos 1 registro em dados pessoais
        $dadosPessoais = $user->dadosPessoais()->count();
        //valida se existe ao menos 1 curriculo pdf
        $curriculo = $user->curriculo()->count();
        // valida se existe o endereco cadastrado
        // Verifica se o usuário possui dados pessoais e se tem um endereço associado
        $dadosPessoaisData = $user->dadosPessoais;
        if ($dadosPessoaisData && $dadosPessoaisData->endereco) {
            // O usuário possui um endereço
            $endereco = $dadosPessoaisData->endereco->count();
            // Continue com a lógica aqui
        } else {
            // O usuário não possui um endereço
            $endereco = null;
        }
        
        // if para validar se o usuário possui todos os dados necessários para se candidatar a uma vaga
        if($formacao > 0 && $dadosPessoais > 0 && $curriculo > 0 && $endereco > 0){
            // Criar um novo interesse com os dados fornecidos
            UserArea::create($request->all());
            // Redirecionar para a lista de funções com uma mensagem de sucesso
            return redirect()->route('home')->with('success', 'Interesse criado com sucesso!');
        }else{
            // Redirecionar para a lista de funções com uma mensagem de erro
            return redirect()->route('home')->with('error', 'Para se candidatar a uma vaga é necessário preencher todos os dados pessoais, formação, curriculo e endereço!');
        }



        // Retornar a view para editar a Area
        return view('home', compact('area'));
    }



}
