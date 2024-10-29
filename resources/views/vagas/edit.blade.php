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
                            <h4>  {{ __('Editar vaga') }}</h4>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('vaga.update', $vaga->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-2">
                            <label for="titulo">{{ __('Titulo') }}</label>
                            <input id="titulo" type="text" class="form-control @error('titulo') is-invalid @enderror" name="titulo" value="{{ $vaga->titulo }}" required autocomplete="titulo" autofocus>

                            @error('titulo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group mb-2">
                            <label for="unidade">{{ __('Unidade') }}</label>
                            <select class="form-select form-select-md mb-3" id="unidade" name="unidade" required>
                                @foreach($unidades_negocio as $unidade)
                                    <option value="{{ $unidade->id }}" {{ $vaga->unidade_id == $unidade->id ? 'selected' : '' }}>{{ $unidade->descricao }}</option>
                                @endforeach
                            </select>

                            @error('unidade')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- setor -->
                         <div class="form-group mb-2">
                            <label for="setor">{{ __('Setor responsável') }}</label>
                            <select class="form-select form-select-md mb-3" id="setor" name="setor" required>
                                @foreach($setores as $setor)
                                    <option value="{{ $setor->id }}" {{ $vaga->setor_responsavel_id == $setor->id ? 'selected' : '' }}>{{ $setor->nome }}</option>
                                @endforeach
                            </select>

                            @error('setor')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group mb-2 mt-3">
                            <label for="funcoes">Vincular vaga à função:</label>
                            <a href="#" data-toggle="collapse" data-target="#funcoes-collapse">Mostrar funções</a>
                            <div id="funcoes-collapse" class="collapse">
                                <div class="list-group">
                                    @foreach ($funcoes as $funcao)
                                        <label class="list-group-item">
                                            <input type="checkbox" name="funcoes[]" value="{{ $funcao->id }}" class="form-check-input" {{ isset($vagaFuncoes) && in_array($funcao->id, $vagaFuncoes) ? 'checked' : '' }}>
                                            {{ $funcao->nome }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- cargo -->
                        <div class="form-group mb-2">
                            <label for="cargo">{{ __('Cargo') }}</label>
                            <select class="form-select form-select-md mb-3" id="cargo" name="cargo" required>
                                @foreach($cargos as $cargo)
                                    <option value="{{ $cargo->id }}" {{ $vaga->cargo_id == $cargo->id ? 'selected' : '' }}>{{ $cargo->nome }}</option>
                                @endforeach
                            </select>

                            @error('cargo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        
                        <div class="form-group mb-2">
                            <label for="descricao">{{ __('Descrição da vaga') }}</label>
                            <textarea id="descricao" class="form-control @error('descricao') is-invalid @enderror" name="descricao" required>{{ $vaga->descricao }}</textarea>

                            @error('descricao')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Data - Início de vigência -->

                        <div class="form-group mb-2">
                            <label for="data_inicio_vigencia">{{ __('Início de vigência') }}</label>
                            <input id="data_inicio_vigencia" type="date" class="form-control @error('data_inicio_vigencia') is-invalid @enderror" name="data_inicio_vigencia" value="{{ $vaga->data_inicio_vigencia }}" required>

                            @error('data_inicio_vigencia')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Data - Término de vigência -->

                        <div class="form-group mb-2">
                            <label for="data_termino_vigencia">{{ __('Término de vigência') }}</label>
                            <input id="data_termino_vigencia" type="date" class="form-control @error('data_termino_vigencia') is-invalid @enderror" name="data_termino_vigencia" value="{{ $vaga->data_termino_vigencia }}" required>

                            @error('data_termino_vigencia')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Prazo para contratação -->
                         <div class="form-group mb-2">
                            <label for="prazo_contratacao">{{ __('Prazo para contratação') }}</label>
                            <input id="prazo_contratacao" type="date" class="form-control @error('prazo_contratacao') is-invalid @enderror" name="prazo_contratacao" value="{{ $vaga->prazo_contratacao }}" required>

                            @error('prazo_contratacao')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        
                        <!-- tipo de vaga -->
                        <div class="form-group mb-2">
                            <label for="tipo_vaga">{{ __('Tipo de contrato') }}</label>
                            
                            <select class="form-select form-select-md mb-3" aria-label="Large select example" id="tipo_vaga" name="tipo_vaga" required autocomplete="tipo_vaga">
                                <option value="Estágio" {{ old('tipo_vaga', $vaga->tipo_vaga) == 'Estágio' ? 'selected' : '' }}>Estágio</option>
                                <option value="CLT" {{ old('tipo_vaga', $vaga->tipo_vaga) == 'CLT' ? 'selected' : '' }}>CLT</option>
                                <option value="CLT Híbrido" {{ old('tipo_vaga', $vaga->tipo_vaga) == 'CLT Híbrido' ? 'selected' : '' }}>CLT Híbrido</option>
                                <option value="Temporário" {{ old('tipo_vaga', $vaga->tipo_vaga) == 'Temporário' ? 'selected' : '' }}>Temporário</option>
                                <option value="PJ" {{ old('tipo_vaga', $vaga->tipo_vaga) == 'PJ' ? 'selected' : '' }}>PJ</option>
                            </select>

                            @error('tipo_vaga')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <!-- situação  Rascunho, Pendente, Em Aprovação, Aprovada, Publicada, Encerrada, Cancelada, Suspensa;-->
                        <div class="form-group mb-2">
                            <label for="situacao_vaga">{{ __('Situação') }}</label>
                            <select id="situacao_vaga" name="situacao_vaga" class="form-control @error('situacao_vaga') is-invalid @enderror">
                                <option value="Rascunho" {{ $vaga->situacao_vaga == 'Rascunho' ? 'selected' : '' }}>Rascunho</option>
                                <option value="Pendente" {{ $vaga->situacao_vaga == 'Pendente' ? 'selected' : '' }}>Pendente</option>
                                <option value="Em Aprovação" {{ $vaga->situacao_vaga == 'Em Aprovação' ? 'selected' : '' }}>Em Aprovação</option>
                                <option value="Aprovada" {{ $vaga->situacao_vaga == 'Aprovada' ? 'selected' : '' }}>Aprovada</option>
                                <option value="Publicada" {{ $vaga->situacao_vaga == 'Publicada' ? 'selected' : '' }}>Publicada</option>
                                <option value="Encerrada" {{ $vaga->situacao_vaga == 'Encerrada' ? 'selected' : '' }}>Encerrada</option>
                                <option value="Cancelada" {{ $vaga->situacao_vaga == 'Cancelada' ? 'selected' : '' }}>Cancelada</option>
                                <option value="Suspensa" {{ $vaga->situacao_vaga == 'Suspensa' ? 'selected' : '' }}>Suspensa</option>
                            </select>

                            @error('situacao_vaga')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-2">
                            <label for="status">{{ __('Ativo') }}</label>
                            <select id="status" name="status" class="form-select form-select-md mb-3" required>
                                <option value="Sim" {{ $vaga->status == 'Sim' ? 'selected' : '' }}>Sim</option>
                                <option value="Não" {{ $vaga->status == 'Não' ? 'selected' : '' }}>Não</option>
                            </select>

                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group mb-2">
                            <label for="salario">{{ __('Salário') }}</label>
                            <input id="salario" type="text" class="form-control @error('salario') is-invalid @enderror" name="salario" value="{{ $vaga->salario }}" required>

                            @error('salario')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- input hidden user id que fez a alteração -->
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        
                        <div class="row mb-3 mt-5">
                            <div class="col-md-9">
                                <h4 class="text-left mb-3">Perguntas específicas da vaga</h4>
                            </div>
                        </div>
                        
                        <h2>Perguntas Associadas</h2>
                        @foreach($perguntas as $pergunta)
                            <div class="form-group mb-2">
                                <label for="pergunta">{{ __('Pergunta') }}</label>
                                <input id="pergunta_{{ $pergunta->id }}" type="text" class="form-control @error('pergunta') is-invalid @enderror" name="pergunta[{{ $pergunta->id }}]" value="{{ $pergunta->pergunta ?? '' }}" required autocomplete="pergunta" autofocus>
                            </div>
                        
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" id="text_resp_{{ $pergunta->id }}" name="text_resp[{{ $pergunta->id }}]" value='true' {{ ($pergunta->freeText ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="text_resp_{{ $pergunta->id }}">
                                    Resposta em texto livre?
                                </label>
                            </div>
                        
                            <div id='opt_resp_{{ $pergunta->id }}' style="display: {{ ($pergunta->freeText ?? true) ? 'none' : 'block' }}">
                                <br><br>
                        
                                <div class="form-group mb-2" id="opcoes-container">
                                    <label class="form-check-label">Escreva uma opção de resposta:</label>
                                    <input id='input_option_{{ $pergunta->id }}' type="text" class="form-control">
                                </div>
                        
                                <div class="form-group mb-2" id="opcoes-container">
                                    <button type="button" class="btn btn-principal adicionar-opcao" data-pergunta-id="{{ $pergunta->id }}">Adicionar Opção</button>

                                </div>
                        
                                <div class="form-group mb-2 mt-4">
                                    <input id='options_{{ $pergunta->id }}' type="hidden" name="options[{{ $pergunta->id }}]" value="{{ $pergunta->options ?? '' }}">
                        
                                    <table class="table table-bordered">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th style="width: 90%;">Opção</th>
                                                <th style="width: 10%;">Excluir</th>
                                            </tr>
                                        </thead>
                                        <tbody id='tbodyOptions_{{ $pergunta->id }}'>
                                            @foreach($pergunta->optionsList ?? [] as $option)
                                                <tr>
                                                    <td class='opcoes'>{{ $option }}</td>
                                                    <td><button type="button" class="btn btn-danger" onclick="removeOpt(this)">Excluir</button></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                        
                                <div class="form-check mt-3">
                                    <input class="form-check-input text_resp" type="checkbox" id="text_resp_{{ $pergunta->id }}" name="text_resp[{{ $pergunta->id }}]" value='true' {{ ($pergunta->freeText ?? true) ? 'checked' : '' }} data-pergunta-id="{{ $pergunta->id }}">
                                    <label class="form-check-label" for="mult_resps_{{ $pergunta->id }}">
                                        Permitir múltiplas respostas
                                    </label>
                                </div>
                            </div>
                        @endforeach
                        

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


<script type="text/javascript">
    document.querySelectorAll('.adicionar-opcao').forEach((button) => {
        button.addEventListener('click', function() {
            let inputId = 'input_option_' + this.dataset.perguntaId; // ID do input baseado no ID da pergunta
            let input = document.getElementById(inputId);

            let tbodyId = 'tbodyOptions_' + this.dataset.perguntaId; // ID do tbody baseado no ID da pergunta
            let tbody = document.getElementById(tbodyId);
            let tr = tbody.insertRow(-1);
            let td = tr.insertCell(0);
            td.textContent = input.value;
            td.classList.add('opcoes');

            tr.insertCell(1).innerHTML = '<button type="button" class="btn btn-danger" onclick="removeOpt(this)">Excluir</button>';

            input.value = '';

            attOptions(tbodyId, inputId);
        });
    });

    document.querySelectorAll('.text_resp').forEach((checkbox) => {
        checkbox.addEventListener('click', function() {
            let optRespId = 'opt_resp_' + this.dataset.perguntaId; // ID do div opt_resp baseado no ID da pergunta
            document.getElementById(optRespId).style.display = this.checked ? 'none' : 'block';
        });
    });

    function attOptions(tbodyId, inputId) {
        let options = document.getElementById('options_' + inputId.split('_')[2]); // ID baseado no input

        let conteudos = [];
        let divs = document.querySelectorAll(`#${tbodyId} .opcoes`);
        divs.forEach((div) => {
            conteudos.push(div.textContent || div.innerText);
        });

        options.value = JSON.stringify(conteudos);
    }

    function removeOpt(el) {
        el.closest('tr').remove();
        attOptions(el.closest('tbody').id, el.closest('tbody').previousElementSibling.querySelector('input').id);
    }
</script>



@endsection
