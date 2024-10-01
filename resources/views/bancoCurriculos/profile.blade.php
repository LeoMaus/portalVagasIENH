@extends('layouts.app')
@extends('general')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h3>{{ __('Visualização do Candidato') }}</h3>
                </div>
                <class="card-body">
                    <!-- Detalhes Pessoais do Candidato -->
                    <h4 class="mb-3">{{ __('Dados Pessoais') }}</h4>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <strong>{{ __('Nome:') }}</strong> {{ $user->name }}
                        </div>
                        <div class="col-md-6">
                            <strong>{{ __('Email:') }}</strong> {{ $user->email }}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <strong>{{ __('Data de Nascimento:') }}</strong> {{ optional($user->dadosPessoais)->data_nascimento }}
                        </div>
                        <div class="col-md-6">
                            <strong>{{ __('Telefone:') }}</strong> {{ isset($user->dadosPessoais->contato) ? $user->dadosPessoais->contato->telefone : '' }}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <strong>{{ __('Celular:') }}</strong> {{ isset($user->dadosPessoais->contato) ? $user->dadosPessoais->contato->celular : '' }}
                        </div>
                        <div class="col-md-6">
                            <strong>{{ __('CPF/CNPJ:') }}</strong> {{ $user->cpf_cnpj }}
                        </div>
                    </div>

                    <!-- Endereço do Candidato -->
                    <h4 class="mb-3">{{ __('Endereço') }}</h4>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <strong>{{ __('Rua:') }}</strong> {{ isset($user->dadosPessoais->endereco) ? $user->dadosPessoais->endereco->rua : '' }}
                        </div>
                        <div class="col-md-6">
                            <strong>{{ __('Número:') }}</strong> {{ isset($user->dadosPessoais->endereco) ? $user->dadosPessoais->endereco->numero : '' }}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <strong>{{ __('Bairro:') }}</strong> {{ isset($user->dadosPessoais->endereco) ? $user->dadosPessoais->endereco->bairro : '' }}
                        </div>
                        <div class="col-md-6">
                            <strong>{{ __('CEP:') }}</strong> {{ isset($user->dadosPessoais->endereco) ? $user->dadosPessoais->endereco->cep : '' }}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <strong>{{ __('Cidade:') }}</strong> {{ isset($user->dadosPessoais->endereco) ? $user->dadosPessoais->endereco->cidade : '' }}
                        </div>
                        <div class="col-md-6">
                            <strong>{{ __('Estado:') }}</strong> {{ isset($user->dadosPessoais->endereco) ? $user->dadosPessoais->endereco->estado : '' }}
                        </div>
                    </div>
                    <br><br>
                    <!-- Formação -->
                    <h4 class="mb-3">{{ __('Formação') }}</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>{{ __('Curso') }}</th>
                                <th>{{ __('Instituição') }}</th>
                                <th>{{ __('Nível') }}</th>
                                <th>{{ __('Inicio') }}</th>
                                <th>{{ __('Conclusão') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($formacao as $formacoes)
                            <tr>
                                <td>{{ $formacoes->curso }}</td>
                                <td>{{ $formacoes->instituicao }}</td>
                                <td>{{ $formacoes->nivelEstudo->nivel }}</td>
                                <td>{{ $formacoes->data_inicio }}</td>
                                <td>{{ $formacoes->data_fim }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br><br>


                    <!-- Habilidades e Link -->
                    <h4 class="mb-3">{{ __('Habilidades') }}</h4>
                    <p>{{ isset($user->dadosPessoais) ? $user->dadosPessoais->habilidades : 'Nenhuma habilidade adicionada' }}</p>

                    <h4 class="mb-3">{{ __('Link Externo') }}</h4>
                    <p><a href="{{ optional($user->dadosPessoais)->link }}" target="_blank">{{ optional($user->dadosPessoais)->link }}</a></p>
                    
                    <h4 class="mb-3">{{ __('Currículo em PDF') }}</h4>

                    
                    <a href="{{ route('curriculo.show', [$curriculo->id]) }}" class="btn btn-principal">Visualizar Currículo existente</a>

                    <!-- Botões de Ação -->
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <a href="{{ route('bancoCurriculos.index') }}" class="btn btn-secondary">{{ __('Voltar à Lista') }}</a>
                            <!-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal">{{ __('Excluir Candidato') }}</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Confirmação de Exclusão -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Exclusão</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tem certeza de que deseja excluir este candidato?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <form method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Confirmar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection