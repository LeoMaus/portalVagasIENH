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
                            <h4>{{ __('Cadastrar função') }}</h4>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('funcao.store') }}">
                        @csrf

                        <div class="form-group mb-2">
                            <label for="nome">{{ __('Nome') }}</label>
                            <input id="nome" type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{ old('nome') }}" required autocomplete="nome" autofocus>

                            @error('nome')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        
                        </div>

                        <div class="form-group mb-4">
                            <label for="descricao">{{ __('Descrição da função') }}</label>
                            <textarea id="descricao" class="form-control @error('descricao') is-invalid @enderror" name="descricao" placeholder="Descreva aqui a vaga" required>{{ old('descricao') }}</textarea>
                        
                            @error('descricao')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="responsabilidades">{{ __('Responsabilidades') }}</label>
                            <textarea id="responsabilidades" class="form-control @error('responsabilidades') is-invalid @enderror" name="responsabilidades" placeholder="Descreva aqui a vaga" required>{{ old('responsabilidades') }}</textarea>
                        
                            @error('responsabilidades')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <center>
                                <a type="button" id="back-button" href="{{ route('funcao.index') }}" class="btn btn-secondary">
                                    {{ __('Voltar') }}
                                </a>
                                <button type="submit" id="save-button" class="btn btn-principal">
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
