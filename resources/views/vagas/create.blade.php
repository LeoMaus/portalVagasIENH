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
                            <h4>  {{ __('Cadastrar vaga') }}</h4>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('vaga.store') }}">
                        @csrf

                        <div class="form-group mb-2">
                            <label for="titulo">{{ __('Titulo') }}</label>
                            <input id="titulo" type="text" class="form-control @error('titulo') is-invalid @enderror" name="titulo" value="{{ old('titulo') }}" required autocomplete="titulo" autofocus>

                            @error('titulo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        
                        </div>

                        <div class="form-group mb-2">
                            <label for="unidade">{{ __('Unidade') }}</label>
                            
                            <select class="form-select form-select-md mb-3" aria-label="Large select example" id="unidade" type="unidade" class="form-control @error('unidade') is-invalid @enderror" name="unidade" value="{{ old('unidade') }}" required autocomplete="unidade">
                            @foreach($unidades_negocio as $unidade)
                                <option value="{{$unidade->id}}">{{$unidade->descricao}}</option>
                            @endforeach
                            </select>

                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="setor">{{ __('Setor responsável') }}</label>
                            
                            <select class="form-select form-select-md mb-3" aria-label="Large select example" id="setor" type="setor" class="form-control @error('setor') is-invalid @enderror" name="setor" value="{{ old('setor') }}" required autocomplete="setor">
                            @foreach($setores as $setor)
                                <option value="{{$setor->id}}">{{$setor->nome}}</option>
                            @endforeach
                            </select>

                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        
                        </div>


                        <div class="form-group mb-2 mt-3">
                        <!-- Outros campos da pergunta -->
                        <label for="funcoes">Vincular vaga a função:</label>
                        <a href="#" data-toggle="collapse" data-target="#funcoes-collapse">Mostrar funções</a>
                            <div id="funcoes-collapse" class="collapse">
                                <div class="list-group">
                                    @foreach ($funcoes as $funcao)
                                        <label class="list-group-item">
                                            <input type="checkbox" name="funcoes[]" value="{{ $funcao->id }}" class="form-check-input" {{isset($vagaFuncoes) && in_array($funcao->id, $vagaFuncoes) ? 'checked' : '' }} >
                                            {{ $funcao->nome }}
                                        </label>
                                @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- selecionar cargo -->
                        <div class="form-group mb-2">
                            <label for="cargo">{{ __('Cargo') }}</label>
                            
                            <select class="form-select form-select-md mb-3" aria-label="Large select example" id="cargo" type="cargo" class="form-control @error('cargo') is-invalid @enderror" name="cargo" value="{{ old('cargo') }}" required autocomplete="cargo">
                            @foreach($cargos as $cargo)
                                <option value="{{$cargo->id}}">{{$cargo->nome}}</option>
                            @endforeach
                            </select>

                            @error('cargo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- <div class="form-group mb-2">
                            <label for="status">{{ __('Status') }}</label>
                            
                            <select class="form-select form-select-md mb-3" aria-label="Large select example" id="status" type="status" class="form-control @error('status') is-invalid @enderror" name="status" value="{{ old('status') }}" required autocomplete="status">
                                <option value="Aberta" selected>Aberta </option>
                                <option value="Fechada">Fechada</option>
                            </select>

                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        
                        </div> -->

                        <div class="form-group mb-4">
                            <label for="descricao">{{ __('Descrição da vaga') }}</label>
                            <textarea id="descricao" class="form-control @error('descricao') is-invalid @enderror" name="descricao" placeholder="Descreva aqui a vaga" required>{{ old('descricao') }}</textarea>
                        
                            @error('descricao')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="data_inicio_vigencia">{{ __('Data - Início de vigência') }}</label>
                            <input id="data_inicio_vigencia" type="date" class="form-control @error('data_inicio_vigencia') is-invalid @enderror" name="data_inicio_vigencia" value="{{ old('data_inicio_vigencia') }}" required autocomplete="data_inicio_vigencia" autofocus>

                            @error('data_inicio_vigencia')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="data_termino_vigencia">{{ __('Data - Término de vigência') }}</label>
                            <input id="data_termino_vigencia" type="date" class="form-control @error('data_termino_vigencia') is-invalid @enderror" name="data_termino_vigencia" value="{{ old('data_termino_vigencia') }}" required autocomplete="data_termino_vigencia" autofocus>

                            @error('data_termino_vigencia')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- prazo para contratação -->
                        <div class="form-group mb-2">
                            <label for="prazo_contratacao">{{ __('Prazo para contratação') }}</label>
                            <input id="prazo_contratacao" type="date" class="form-control @error('prazo_contratacao') is-invalid @enderror" name="prazo_contratacao" value="{{ old('prazo_contratacao') }}" required autocomplete="prazo_contratacao" autofocus>

                            @error('prazo_contratacao')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- tipo de vaga -->
                        <div class="form-group mb-2">
                            <label for="tipo_vaga">{{ __('Tipo de contrato') }}</label>
                            
                            <select class="form-select form-select-md mb-3" aria-label="Large select example" id="tipo_vaga" type="tipo_vaga" class="form-control @error('tipo_vaga') is-invalid @enderror" name="tipo_vaga" value="{{ old('tipo_vaga') }}" required autocomplete="tipo_vaga">
                                <option value="Estágio" selected>Estágio </option>
                                <option value="CLT">CLT</option>
                                <option value="CLT Híbrido">CLT Híbrido</option>
                                <option value="Temporário">Temporário</option>
                                <option value="PJ">PJ</option>
                            </select>

                            @error('tipo_vaga')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- situação  Rascunho, Pendente, Em Aprovação, Aprovada, Publicada, Encerrada, Cancelada, Suspensa;-->
                        <div class="form-group mb-2">
                            <label for="situacao">{{ __('Situação') }}</label>
                            
                            <select class="form-select form-select-md mb-3" aria-label="Large select example" id="situacao" type="situacao" class="form-control @error('situacao') is-invalid @enderror" name="situacao" value="{{ old('situacao') }}" required autocomplete="situacao">
                                <option value="Rascunho" selected>Rascunho </option>
                                <option value="Pendente">Pendente</option>
                                <option value="Em Aprovação">Em Aprovação</option>
                                <option value="Aprovada">Aprovada</option>
                                <option value="Publicada">Publicada</option>
                                <option value="Encerrada">Encerrada</option>
                                <option value="Cancelada">Cancelada</option>
                                <option value="Suspensa">Suspensa</option>
                            </select>

                            @error('situacao')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- ativo -->
                        <div class="form-group  mb-2">
                            <label for="ativo">{{ __('Ativo') }}</label>
                            
                            <select class="form-select form-select-md mb-3" aria-label="Large select example" id="ativo" type="ativo" class="form-control @error('ativo') is-invalid @enderror" name="ativo" value="{{ old('ativo') }}" required autocomplete="ativo">
                                <option value="Sim" selected>Sim </option>
                                <option value="Não">Não</option>
                            </select>

                            @error('ativo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- salário -->
                        <div class="form-group mb-2">
                            <label for="salario">{{ __('Salário') }}</label>
                            <input id="salario" type="text" class="form-control @error('salario') is-invalid @enderror" name="salario" value="{{ old('salario') }}" required autocomplete="salario" autofocus>

                            @error('salario')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- input hidden usuário de criação -->
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        
                        

                        <div class="form-group mb-2">
                            <center>
                                <a type="button" href="{{route('vaga.index')}}" class="btn btn-secondary">
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
