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
                            <h4>  {{ __('Cadastrar Cargo') }}</h4>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('cargo.store') }}">
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
                            <label for="descricao">{{ __('Descrição do cargo') }}</label>
                            <textarea id="descricao" class="form-control @error('descricao') is-invalid @enderror" name="descricao" placeholder="Descreva aqui o cargo" required autocomplete="descricao" autofocus>{{ old('descricao') }}</textarea>
                        
                            @error('descricao')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="responsabilidades">{{ __('Responsabilidades') }}</label>
                            <textarea id="responsabilidades" class="form-control @error('responsabilidades') is-invalid @enderror" name="responsabilidades" placeholder="Descreva aqui a vaga" required autocomplete="responsabilidades" autofocus>{{ old('responsabilidades') }}</textarea>
                        
                            @error('responsabilidades')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <label for="area">Selecione a Área:</label>
                        <select name="area_id" id="area" class="form-control" required>
                            <option value="">Escolha uma área</option>
                            @foreach($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->nome }}</option>
                            @endforeach
                        </select>
                        

                        <div class="form-group mb-2">
                            <center>
                                <a type="button" href="{{route('cargo.index')}}" class="btn btn-secondary">
                                    {{ __('Voltar') }}
                                </a>
                                <button type="submit" class="btn btn-principal">
                                    {{ __('Salvar') }}
                                </button>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
