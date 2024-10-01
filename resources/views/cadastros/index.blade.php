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
                                ['title' => 'Banco de currículos', 'description' => 'Visualize o banco de currículos com base em áreas de interesses.', 'route' => 'bancoCurriculos.index'],
                                ['title' => 'Unidade de negócio', 'description' => 'Visualize e edite as unidades de negócio.', 'route' => 'unidadeNegocio.index'],
                                ['title' => 'Perguntas', 'description' => 'Visualize e edite as perguntas desejadas.', 'route' => 'pergunta.index'],
                                ['title' => 'Vagas', 'description' => 'Gerencie e edite as informações das vagas cadastradas.', 'route' => 'vaga.index'],
                                ['title' => 'Área de atuação', 'description' => 'Visualize e edite as áreas de atuação.', 'route' => 'area.index'],
                                ['title' => 'Cargos', 'description' => 'Gerencie e edite os cargos disponíveis nas vagas.', 'route' => 'cargo.index'],
                                ['title' => 'Função', 'description' => 'Visualize e edite as funções específicas para cada cargo.', 'route' => 'funcao.index']
                            ];
                        @endphp

                        @foreach ($cards as $card)
                            <div class="card mt-3">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $card['title'] }}</h5>
                                    <p class="card-text">{{ $card['description'] }}</p>
                                    <a href="{{ route($card['route']) }}" class="btn btn-principal">Acessar</a>
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
