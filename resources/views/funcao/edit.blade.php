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
                            <h4>{{ __('Editar função') }}</h4>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('funcao.update', $funcao->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-2">
                            <label for="nome">{{ __('Nome') }}</label>
                            <input id="nome" type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{ $funcao->nome }}" required autocomplete="nome" autofocus>

                            @error('nome')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        
                        </div>

                        <div class="form-group mb-2">
                            <label for="descricao">{{ __('Descrição') }}</label>
                            <input id="descricao" type="text" class="form-control @error('descricao') is-invalid @enderror" name="descricao" value="{{ $funcao->descricao }}" required autocomplete="descricao" autofocus>

                            @error('descricao')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        
                        </div>

                        <div class="form-group mb-2">
                            <label for="responsabilidades">{{ __('Responsabilidades') }}</label>
                            <input id="responsabilidades" type="text" class="form-control @error('responsabilidades') is-invalid @enderror" name="responsabilidades" value="{{ $funcao->responsabilidades }}" required autocomplete="responsabilidades" autofocus>

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
