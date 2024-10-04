<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

use App\Http\Controllers\PerguntaController;
use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\FuncaoController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\UnidadeNegocioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [Controllers\WelcomeController::class, 'index'])->name('welcome');

Route::get('/home', [Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => 'auth'], function () {
    // Rotas de administração aqui
    Route::group(['middleware' => ['auth', 'checkRole:admin']], function () {
        Route::get('/users', [Controllers\UsersController::class, 'index'])->name('users');
    });

    Route::get('/formCreate', [Controllers\UsersController::class, 'formCreate'])->name('formCreate');

    Route::post('/create', [Controllers\UsersController::class, 'create'])->name('create');

    Route::delete('/users/{id}', [Controllers\UsersController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/{id}', [Controllers\UsersController::class, 'restore'])->name('users.restore');

    Route::get('/formEdit/{id}', [Controllers\UsersController::class, 'formEdit'])->name('formEdit');

    Route::put('/edit/{id}', [Controllers\UsersController::class, 'edit'])->name('edit');

    Route::get('/profile', [Controllers\UsersController::class, 'profile'])->name('profile');

    Route::get('/cidades/{estado_id}', [Controllers\UsersController::class, 'cidadesPorEstado'])->name('cidadesPorEstado');

    # rota para editar perfil dados padrão, nome, senha, email
    Route::put('/editProfile/{id}', [Controllers\UsersController::class, 'editProfile'])->name('editProfile');

    # rota para editar dados pessoais
    Route::put('/editDadosPessoais/{id}', [Controllers\UsersController::class, 'editDadosPessoais'])->name('editDadosPessoais');

    # rota para página de cadastros
    Route::get('/cadastros', [Controllers\CadastrosController::class, 'index'])->name('cadastros.index');
   


    # rotas para vagas
    Route::name('vaga.')->prefix('vagas')->group(function () {
        $class = Controllers\VagasController::class;
        Route::name('index')   ->get('',                [$class, 'index']);
        Route::name('create')  ->get('create',          [$class, 'create']);
        Route::name('show')    ->get('{vaga}',          [$class, 'show']);
        Route::name('edit')    ->get('{vaga}/edit',     [$class, 'edit']);
        Route::name('store')   ->post('',               [$class, 'store']);
        Route::name('update')  ->put('{vaga}',          [$class, 'update']);
        Route::name('destroy') ->delete('{vaga}',       [$class, 'destroy']);
    });

    Route::name('funcao.')->prefix('funcao')->group(function () {
        $class = Controllers\FuncaoController::class;
        Route::name('index')   ->get('',                [$class, 'index']);
        Route::name('create')  ->get('create',          [$class, 'create']);
        Route::name('edit')    ->get('{funcao}/edit',   [$class, 'edit']);
        Route::name('update')  ->put('{funcao}',        [$class, 'update']);
        Route::name('destroy') ->delete('{funcao}',     [$class, 'destroy']);
        Route::name('store')   ->post('',               [$class, 'store']);
    });


    Route::name('area.')->prefix('area')->group(function () {
        $class = Controllers\AreaController::class;
        Route::name('index')   ->get('',                [$class, 'index']);
        Route::name('create')  ->get('create',          [$class, 'create']);
        Route::name('edit')    ->get('{area}/edit',   [$class, 'edit']);
        Route::name('update')  ->put('{area}',        [$class, 'update']);
        Route::name('destroy') ->delete('{area}',     [$class, 'destroy']);
        Route::name('store')   ->post('',               [$class, 'store']);
        Route::name('interesseArea')    ->post('interesse',   [$class, 'interesseArea']);
        Route::name('show')    ->get('show',             [$class, 'show']);    // Exibe detalhes de todas as áreas
        Route::name('interesse.cancel')    ->delete('{area}/cancel',   [$class, 'interessecancel']); // Nova rota para cancelar interesse
    });

    Route::name('cargo.')->prefix('cargo')->group(function () {
        $class = Controllers\CargoController::class;
        Route::name('index')   ->get('',                [$class, 'index']);
        Route::name('create')  ->get('create',          [$class, 'create']);
        Route::name('edit')    ->get('{cargo}/edit',   [$class, 'edit']);
        Route::name('update')  ->put('{cargo}',        [$class, 'update']);
        Route::name('destroy') ->delete('{cargo}',     [$class, 'destroy']);
        Route::name('store')   ->post('',               [$class, 'store']);
    });

    Route::name('unidadeNegocio.')->prefix('unidadeNegocio')->group(function () {
        $class = Controllers\UnidadeNegocioController::class;
        Route::name('index')   ->get('',                [$class, 'index']);
        Route::name('create')  ->get('create',          [$class, 'create']);
        Route::name('edit')    ->get('{unidadeNegocio}/edit',   [$class, 'edit']);
        Route::name('update')  ->put('{unidadeNegocio}',        [$class, 'update']);
        Route::name('destroy') ->delete('{unidadeNegocio}',     [$class, 'destroy']);
        Route::name('store')   ->post('',               [$class, 'store']);
    });

    # rotas para perguntas
    Route::name('pergunta.')->prefix('pergunta')->group(function () {
        $class = PerguntaController::class;
        Route::name('index')   ->get('',                [$class, 'index']);
        Route::name('create')  ->get('create',          [$class, 'create']);
        Route::name('show')    ->get('{pergunta}',      [$class, 'show']);
        Route::name('edit')    ->get('{pergunta}/edit', [$class, 'edit']);
        Route::name('store')   ->post('',               [$class, 'store']);
        Route::name('update')  ->put('{pergunta}',      [$class, 'update']);
        Route::name('destroy') ->delete('{pergunta}',   [$class, 'destroy']);
    });


    # rotas do perfil do candidado
    Route::name('candidato.')->prefix('candidato')->group(function () {
        $class = Controllers\CandidatoController::class;
        Route::name('index')   ->get('',               [$class, 'index']);
        Route::name('edit')    ->get('/edit',          [$class, 'edit']);
        Route::name('update')  ->put('{candidato}',    [$class, 'update']);
        Route::name('show')    ->get('',               [$class, 'show']);
        Route::name('cancel')  ->delete('{vaga}',      [$class, 'cancel']);
    });

    # rotas para perfil
    Route::name('perfil.')->prefix('perfil')->group(function () {
        $class = Controllers\PerfilController::class;
        Route::name('store')   ->post('',        [$class, 'store']);
        Route::name('update')  ->put('{perfil}', [$class, 'update']);
    });

    # rotas para formações
    Route::name('formacao.')->prefix('formacao')->group(function () {
        $class = Controllers\FormacaoController::class;
        Route::name('index')   ->get('',                [$class, 'index']);
        Route::name('create')  ->get('create',          [$class, 'create']);
        Route::name('show')    ->get('{formacao}',      [$class, 'show']);
        Route::name('edit')    ->get('{formacao}/edit', [$class, 'edit']);
        Route::name('store')   ->post('',               [$class, 'store']);
        Route::name('update')  ->put('{formacao}',      [$class, 'update']);
        Route::name('destroy') ->delete('{formacao}',   [$class, 'destroy']);
    });

    # rotas para curriculos
    Route::name('curriculo.')->prefix('curriculo')->group(function () {
        $class = Controllers\CurriculoController::class;
        Route::name('store')   ->post('',                [$class, 'store']);
        Route::name('update')  ->put('{curriculo}',      [$class, 'update']);
        Route::name('show')    ->get('show/{curriculo}', [$class, 'show']);
    });

    # rotas para candidatar-se
    Route::name('candidatar.')->prefix('candidatar')->group(function () {
        $class = Controllers\CandidatarController::class;
        Route::name('index')    ->get('{vaga}',         [$class, 'index']); 
        Route::name('store')   ->post('',               [$class, 'store']);
        Route::name('update')  ->put('{candidatar}',    [$class, 'update']);
    });

    # rotas para curriculosVaga
    Route::name('curriculosVaga.')->prefix('curriculosVaga')->group(function () {
        $class = Controllers\CurriculosVagaController::class;
        Route::name('index')    ->get('{vaga}',          [$class, 'index']); 
        Route::name('show')     ->get('show/{candidatura}',   [$class, 'show']); 
        Route::name('update')   ->post('',               [$class, 'update']); 
    });

    # rotas para feedback
    Route::name('feedback.')->prefix('feedback')->group(function () {
        $class = Controllers\FeedbackController::class;
        Route::name('index')   ->get('',            [$class, 'index']); 
        Route::name('store')   ->post('',           [$class, 'store']);
        Route::name('update')  ->put('{feedback}',  [$class, 'update']);
        Route::name('mail')     ->post('{vaga}/{user}',  [$class, 'mail']);

    });

    # rotas para banco de curriculos
    Route::name('bancoCurriculos.')->prefix('bancoCurriculos')->group(function () {
        $class = Controllers\BancoCurriculosController::class;
        Route::name('index')   ->get('',            [$class, 'index']); 
        Route::name('profile') ->get('{id_user}',   [$class, 'profile']);

    });

    # rotas para modelos de email
    Route::name('email.')->prefix('email')->group(function () {
        $class = Controllers\EmailController::class;

        // Rota para visualizar modelos de e-mail
        Route::name('index')->get('', [$class, 'index']); 

        // Rota para editar um modelo de e-mail específico
        Route::name('editar.modelo.email')->get('editar-modelo/{template}', [$class, 'edit']);

        // Rota para atualizar um modelo de e-mail específico
        Route::name('update.modelo.email')->put('editar-modelo/{template}', [$class, 'update']);
    });




});


// Route::get('/login', [Controllers\AutenticacaoController::class, 'index'])->name('login');

// Route::get('/login', [Controllers\AutenticacaoController::class, 'index'])->name('autenticacao.login');