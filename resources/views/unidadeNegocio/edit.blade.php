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
                            <h4>  {{ __('Editar Unidade de Negócio') }}</h4>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('unidadeNegocio.update', $unidadeNegocio->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-2">
                            <label for="descricao">{{ __('Descrição') }}</label>
                            <input id="descricao" type="text" class="form-control @error('descricao') is-invalid @enderror" name="descricao" value="{{ $unidadeNegocio->descricao }}" required>

                            @error('descricao')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="id_empresa">{{ __('ID Empresa') }}</label>
                            <input id="id_empresa" type="number" class="form-control @error('id_empresa') is-invalid @enderror" name="id_empresa" value="{{ $unidadeNegocio->id_empresa }}" required>

                            @error('id_empresa')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="id_un_pai">{{ __('ID Unidade Pai') }}</label>
                            <input id="id_un_pai" type="number" class="form-control @error('id_un_pai') is-invalid @enderror" name="id_un_pai" value="{{ $unidadeNegocio->id_un_pai }}">

                            @error('id_un_pai')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="id_responsavel">{{ __('ID Responsável') }}</label>
                            <input id="id_responsavel" type="number" class="form-control @error('id_responsavel') is-invalid @enderror" name="id_responsavel" value="{{ $unidadeNegocio->id_responsavel }}">

                            @error('id_responsavel')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="ativo">{{ __('Ativo') }}</label>
                            <select id="ativo" name="ativo" class="form-control @error('ativo') is-invalid @enderror" required>
                                <option value="1" {{ $unidadeNegocio->ativo == 1 ? 'selected' : '' }}>Sim</option>
                                <option value="0" {{ $unidadeNegocio->ativo == 0 ? 'selected' : '' }}>Não</option>
                            </select>

                            @error('ativo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="id_usuario_criacao">{{ __('ID Usuário Criação') }}</label>
                            <input id="id_usuario_criacao" type="number" class="form-control @error('id_usuario_criacao') is-invalid @enderror" name="id_usuario_criacao" value="{{ $unidadeNegocio->id_usuario_criacao }}" required>

                            @error('id_usuario_criacao')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <center>
                                <a type="button" href="{{route('unidadeNegocio.index')}}" class="btn btn-secondary">
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
            <div class="footer">
                <center>
                    <img src="{{ asset('assets/2.png') }}" alt="Logo" class="img-logo-footer mb-5 mt-3">
                </center>
            </div>
        </div>
    </div>
</div>

@endsection
