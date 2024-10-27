@extends('layouts.app')
@extends('general')

@section('content')

<div class="container">
    <div class="row justify-content-center p-5">
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

          
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif


                <div class="table-responsive col-md-12">
                    <h2>Cadastros</h2>

                    @php
                        $cards = [
                            ['title' => 'Unidade de negócio', 'description' => 'Visualize e edite as unidades de negócio.', 'route' => 'unidadeNegocio.index', 'type' => 'Gerenciamento do sistema'],
                            ['title' => 'Perguntas', 'description' => 'Visualize e edite as perguntas desejadas.', 'route' => 'pergunta.index', 'type' => 'Gerenciamento das vagas'],
                            ['title' => 'Vagas', 'description' => 'Gerencie e edite as informações das vagas cadastradas.', 'route' => 'vaga.index', 'type' => 'Gerenciamento das vagas'],
                            ['title' => 'Área de atuação', 'description' => 'Visualize e edite as áreas de atuação.', 'route' => 'area.index', 'type' => 'Gerenciamento das vagas'],
                            ['title' => 'Cargos', 'description' => 'Gerencie e edite os cargos disponíveis nas vagas.', 'route' => 'cargo.index', 'type' => 'Gerenciamento das vagas'],
                            ['title' => 'Função', 'description' => 'Visualize e edite as funções específicas para cada cargo.', 'route' => 'funcao.index', 'type' => 'Gerenciamento das vagas'],
                            ['title' => 'Notificações', 'description' => 'Visualize e edite as notificações do sistema.', 'route' => 'email.index', 'type' => 'Gerenciamento do sistema'],
                            ['title' => 'Usuários e permissões', 'description' => 'Visualize e edite os usuários e suas permissões.', 'route' => 'users', 'type' => 'Gerenciamento do sistema'],
                            ['title' => 'Institucional', 'description' => 'Visualize e edite as informações da sua página institucional.', 'route' => 'home', 'type' => 'Gerenciamento do sistema']
                        ];
                    @endphp

                    <div class="row d-flex justify-content-center mt-5">
                        <h4 class="text-left mb-3">Gerenciamento das vagas</h4>
                        <div class="row d-flex justify-content"> <!-- Linha para os cards de gerenciamento das vagas -->
                            @foreach ($cards as $card)
                                @if($card['type'] == 'Gerenciamento das vagas')
                                    <div class="col-md-4 mb-3"> <!-- Coluna com 4 unidades de largura para 3 colunas -->
                                        <div class="card-cadastro"> 
                                            <div class="card-body card-body-home">
                                                <h5 class="card-title">{{ $card['title'] }}</h5>
                                                <p class="card-text">{{ $card['description'] }}</p>
                                                <a href="{{ route($card['route']) }}" class="btn btn-principal">Acessar</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <h4 class="text-left mb-3 mt-5">Gerenciamento do sistema</h4>
                        <div class="row d-flex justify-content"> <!-- Linha para os cards de gerenciamento do sistema -->
                            @foreach ($cards as $card)
                                @if($card['type'] == 'Gerenciamento do sistema')
                                    <div class="col-md-4 mb-3 d-flex"> <!-- Coluna com 4 unidades de largura para 3 colunas -->
                                        <div class="card-cadastro w-100 d-flex flex-column"> <!-- Card que ocupa 100% da coluna e usa flexbox para alinhar o conteúdo -->
                                            <div class="card-body card-body-home flex-grow-1"> <!-- Faz o card crescer para ocupar o espaço disponível -->
                                                <h5 class="card-title">{{ $card['title'] }}</h5>
                                                <p class="card-text">{{ $card['description'] }}</p>
                                            </div>
                                            <div class="mt-auto"> <!-- Coloca o botão na parte inferior -->
                                                <a href="{{ route($card['route']) }}" class="btn btn-principal">Acessar</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        
                        
                        

                    </div>
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
