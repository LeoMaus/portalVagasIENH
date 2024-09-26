<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;

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
}
