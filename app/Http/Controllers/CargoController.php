<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Models\Area;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    public function index()
    {
        // Buscar todas as funções do banco de dados
        $cargos = Cargo::all();
        
        // Retornar a view com as funções
        return view('cargo.index', ['cargos' => $cargos]);
    }

    public function store(Request $request)
    {
        // Validar os dados do request
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'responsabilidades' => 'nullable|string',
            'area_id' => 'required|exists:area,id',
        ]);

        // Criar uma nova cargo com os dados fornecidos
        cargo::create($request->all());

        // Redirecionar para a lista de funções com uma mensagem de sucesso
        return redirect()->route('cargo.index')->with('status', 'Cargo criado com sucesso!');
    }

    // cargo create 
    public function create()
    {   
        $areas = Area::all();

        // Retornar a view para criar uma nova cargo
        return view('cargo.create', compact('areas'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\cargo $cargo
     * @return \Illuminate\View\View
     */
    
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\cargo $cargo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, cargo $cargo)
    {
        // Validar os dados do request
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'responsabilidades' => 'nullable|string',
            'area_id' => 'required|exists:area,id',
        ]);

        // Atualizar a cargo com os dados fornecidos
        $cargo->update($request->all());

        // Redirecionar para a lista de funções com uma mensagem de sucesso
        return redirect()->route('cargo.index')->with('status', 'Cargo atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\cargo $cargo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(cargo $cargo)
    {
        // Excluir a cargo
        $cargo->delete();

        // Redirecionar para a lista de funções com uma mensagem de sucesso
        return redirect()->route('cargo.index')->with('status', 'Cargo excluído com sucesso!');
    }

    public function edit(cargo $cargo)
    {
        $areas = Area::all();

        // Retornar a view para editar a cargo
        return view('cargo.edit', compact('cargo', 'areas'));
    }
}
