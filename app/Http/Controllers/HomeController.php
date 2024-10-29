<?php

namespace App\Http\Controllers;
use App\Models\Vaga;
use App\Models\Area;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $vagas = Vaga::all();
        $areas = Area::all();
        $quantidadeVagas = Vaga::count();

        return view('home', ['vagas' => $vagas, 'areas' => $areas, 'quantidadeVagas' => $quantidadeVagas]);
    }
}
