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
                            <h4>{{ __('Cadastrar unidade de Negócio') }}</h4>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('unidadeNegocio.store') }}">
                        @csrf

                        <div class="form-group mb-2">
                            <label for="descricao">{{ __('Descrição') }}</label>
                            <input id="descricao" type="text" class="form-control @error('descricao') is-invalid @enderror" name="descricao" value="{{ old('descricao') }}" required autocomplete="descricao" autofocus>
                            @error('descricao')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="id_empresa">{{ __('ID Empresa') }}</label>
                            <select id="id_empresa" name="id_empresa" class="form-control" required>
                                <option value="">Selecione a empresa</option>
                                @foreach($empresas as $empresa)
                                    <option value="{{ $empresa->id }}">{{ $empresa->name }}</option>
                                @endforeach
                            </select>                            @error('id_empresa')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="id_un_pai">{{ __('Unidade de Negócio Pai') }}</label>
                            <select id="id_un_pai" name="id_un_pai" class="form-control" required>
                                <option value="">Selecione uma unidade de negócio</option>
                                @foreach($unidadeNegocios as $unidadeNegocio)
                                    <option value="{{ $unidadeNegocio->id }}">{{ $unidadeNegocio->descricao }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-2">
                            <label for="id_responsavel">{{ __('Responsável') }}</label>
                            <select id="id_responsavel" name="id_responsavel" class="form-control" required>
                                <option value="">Selecione um responsável</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-4 form-check-inline">
                            <label for="ativo">{{ __('Ativo') }}</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="ativo" id="inlineRadio1" value="1" required
                                    {{ $user->ativo === '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio1">Sim</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="ativo" id="inlineRadio2" value="0" required
                                    {{ $user->ativo === '0' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio2">Não</label>
                            </div>
                        </div>

                       

                        <div class="form-group mb-2">
                            <label for="usuario_criacao">{{ __('Usuário Criação') }}</label>
                            <!-- Exibir o nome do usuário -->
                            <input id="usuario_criacao" type="text" class="form-control @error('usuario_criacao') is-invalid @enderror" 
                                   value="{{ Auth::user()->name }}" required disabled>
                            
                            <!-- Campo oculto para enviar o ID -->
                            <input id="id_usuario_criacao" type="hidden" name="id_usuario_criacao" value="{{ Auth::user()->id }}">
                            
                            @error('id_usuario_criacao')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                         <!-- Campo oculto para enviar o ID -->
                         <input id="log" type="hidden" name="log" value="create">
                        

                        <div class="form-group mb-2">
                            <center>
                                <a type="button" href="{{ route('unidadeNegocio.index') }}" class="btn btn-secondary">{{ __('Voltar') }}</a>
                                <button type="submit" class="btn btn-principal">{{ __('Salvar') }}</button>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
