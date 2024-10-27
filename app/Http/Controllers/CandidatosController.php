<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CandidatosController extends Controller
{
    public function index()
    {
        return view('candidatos.index');
    }
}
