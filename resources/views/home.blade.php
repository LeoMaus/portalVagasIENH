@extends('layouts.app')
@extends('general')

@section('content')
<br>
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="col-md-12">
        @if(Auth::user()->role == 'user')
        <h2 class="text-center mt-5 text-white"> Olá, {{ Auth::user()->name }} </h2>
        <p class="text-center text-white">Envie seu currículo online e venha trabalhar conosco!</p>
        @endif

        @if(Auth::user()->role == 'admin')
        <h2 class="text-center mt-5 text-white">{{ __('Vagas disponíveis') }}</h2>
        <p class="text-center text-white">Gerencie suas vagas em aberto!</p>
        @endif
    </div>

    <!-- Centralizar os cards e diminuir o espaçamento entre eles -->
    <div class="row d-flex justify-content-center mt-5">
        @foreach ($vagas as $vaga)
        @if($vaga->status == 'Aberta')
        <div class="col-md-4 d-flex justify-content-center mb-3"> <!-- Diminuir o espaçamento entre os cards com 'mb-3' -->
            <!-- Aumentar a largura dos cards -->
            <div class="card" style="width: 400px;"> <!-- Aumentado para 400px -->
                <div class="card-body card-body-home">
                    <h5 class="card-title">{{ $vaga->titulo }}</h5>
                    <div class="row">
                        <div class="col-md-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                                <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                            </svg>
                        </div>
                        <div class="col-md-9">
                            <p class="card-text">{{ $vaga->unidade->descricao }}</p>
                        </div>
                    </div>
                    @if(Auth::user()->role == 'user')
                    <a href="{{ route('candidatar.index', $vaga->id ) }}" class="btn btn-principal mt-3">Candidate-se</a>
                    @endif
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>

    <div class="row d-flex justify-content-center mt-5">
        <div class="col-md-12">
            <h2 class="text-center text-white">Banco de currículos</h2>
            <p class="text-center text-white">Confira os currículos disponíveis para cada área de atuação</p>
        </div>
    </div>
    <div class="row d-flex justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card bg-light shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-center">Selecione a Área</h5>
                    <form>
                        <div class="mb-3">
                            <label for="areaSelect" class="form-label">Área de Atuação</label>
                            <select id="areaSelect" class="form-select">
                                <option value="" disabled selected>Escolha uma área...</option>
                                <option value="engenharia">Engenharia</option>
                                <option value="ti">Tecnologia da Informação</option>
                                <option value="saude">Saúde</option>
                                <option value="administracao">Administração</option>
                                <!-- Adicione mais opções conforme necessário -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="fileUpload" class="form-label">Upload de Currículo</label>
                            <input type="file" class="form-control" id="fileUpload" accept=".pdf,.doc,.docx">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Enviar Currículo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</div>

@endsection
