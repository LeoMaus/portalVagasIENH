@extends('layouts.app')
@extends('general')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="row mb-3">
                        <div class="col-md-9">
                            <h4>  {{ __('Cadastrar Área') }}</h4>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('area.store') }}">
                        @csrf

                        <div class="form-group mb-2">
                            <label for="nome">{{ __('Nome') }}</label>
                            <input id="nomeInput" type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{ old('nome') }}" required autocomplete="nome" autofocus>

                            @error('nome')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="descricao">{{ __('Descrição da área') }}</label>
                            <textarea id="descricaoInput" class="form-control @error('descricao') is-invalid @enderror" name="descricao" placeholder="Descreva aqui a vaga" required>{{ old('descricao') }}</textarea>

                            @error('descricao')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <center>
                                <a type="button" id="voltarButton" href="{{ route('area.index') }}" class="btn btn-secondary">
                                    {{ __('Voltar') }}
                                </a>
                                <button type="submit" id="salvarButton" class="btn btn-principal">
                                    {{ __('Salvar') }}
                                </button>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
            <div class="footer">
                <center>
                    <img src="{{ asset('assets/2.png') }}" alt="Logo" class="img-logo-footer mb-5 mt-3">
                </center>
            </div>
        </div>
    </div>
</div>

@endsection
