@extends('layouts.app')
@extends('general')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12 mt-5">
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

            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row"></div>

                    <div class="table-responsive col-md-12">
                        <h2>Cadastros</h2>

                        @php
                            $cards = [
                                ['title' => 'Unidade de negócio', 'description' => 'Visualize e edite as unidades de negócio.', 'template' => 'abertura_vaga'],
                                ['title' => 'Perguntas', 'description' => 'Visualize e edite as perguntas desejadas.', 'template' => 'perguntas_candidato'],
                                ['title' => 'Vagas', 'description' => 'Gerencie e edite as informações das vagas cadastradas.', 'template' => 'gerenciar_vagas'],
                                ['title' => 'Área de atuação', 'description' => 'Visualize e edite as áreas de atuação  .', 'template' => 'area_atuacao'],
                                ['title' => 'Cargos', 'description' => 'Gerencie e edite os cargos disponíveis nas vagas.', 'template' => 'gerenciar_cargos'],
                                ['title' => 'Função', 'description' => 'Visualize e edite as funções específicas para cada cargo.', 'template' => 'gerenciar_funcoes']
                            ];
                        @endphp

                        @foreach ($cards as $card)
                            <div class="card mt-3">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $card['title'] }}</h5>
                                    <p class="card-text">{{ $card['description'] }}</p>
                                    <a href="{{ route('email.editar.modelo.email', ['template' => $card['template']]) }}" class="btn btn-principal">Acessar</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection