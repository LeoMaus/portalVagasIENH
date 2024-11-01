@extends('layouts.app')
@extends('general')

@section('content')
<br>
<div class="container">

    <div>
        <img src="{{ asset('assets/capa.png') }}" alt="Logo" class="capa">
    </div>

    <div class="col-md-12">
        <h2 class="text-center mt-5"> Vagas da IENH </h2>
        <p class="text-center texto-institucional">A IENH, instituição de ensino com tradição e excelência, está sempre em busca de inovação e crescimento. Em breve, lançaremos novas oportunidades de trabalho para integrar nosso time dedicado à educação de qualidade. Se você deseja fazer parte de um ambiente que valoriza o conhecimento e o desenvolvimento profissional, fique atento às vagas que serão divulgadas. Venha construir o futuro com a gente!</p>
    </div>

    <div class="row d-flex justify-content-center mt-4">

        <div class="col-md-8">

            <center>
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
            </center>

            <h2 class="text-center mt-4">Confira as oportunidades</h2>
            <form method="POST" action="{{ route('area.interesseArea') }}">
                @csrf
                <div class="mb-3">
                    <label for="areaSelect" class="form-label">Área de Atuação</label>
                    <select id="areaSelect" name="area_id" class="form-select" onchange="updateDescription()">
                        @foreach ($areas as $area)
                        <option value="{{ $area->id }}" data-descricao="{{ $area->descricao }}">{{ $area->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="areaDescricao" class="form-label">Descrição da Área</label>
                    <textarea class="form-control" id="areaDescricao" value="" readonly> </textarea>
                </div>
                <div class="text-center">
                    <button id="submitBancoTalentos" type="submit" class="btn btn-principal mt-3">Banco de Talentos</button>
                </div>
            </form>

            <!-- formulario de pesquisa de vagas -->
            <div class="container my-4">
                <div class="card p-4">
                    <form method="GET" action="{{ route('vaga.pesquisaVaga') }}">
                    @csrf
                        <!-- Barra de pesquisa -->
                        <div class="input-group mb-3">
                            <input id="vagaNome" type="text" name="nome" class="form-control" placeholder="Digite o nome da vaga" aria-label="Nome da vaga">
                            <button id="pesquisaVaga" type="submit" class="btn btn-principal mt-0 mb-0">🔍</button>
                        </div>

                        <!-- Filtros -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <select id="tipoVaga" name="tipo_vaga" class="form-select" aria-label="Tipo de Vaga">
                                    <option selected value="">Tipo de Vaga</option>
                                    <option value="1">Estágio</option>
                                    <option value="2">Temporário</option>
                                    <option value="3">CLT</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select id="localTrabalho" name="local_trabalho" class="form-select" aria-label="Local de Trabalho">
                                    <option selected value="">Local de Trabalho</option>
                                    <option value="1">Presencial</option>
                                    <option value="2">Remoto</option>
                                    <option value="3">Híbrido</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select id="areaFiltro" name="area" class="form-select" aria-label="Área">
                                    <option selected value="">Área</option>
                                    @foreach ($areas as $area)
                                    <option value="{{ $area->id }}">{{ $area->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Contador de resultados -->
                        <div class="text-start">
                            <span class="fw-bold text-danger">Quantidade de vagas: {{ $quantidadeVagas }}</span>
                        </div>
                    </form>
                </div>
            </div>

            <h2 class="text-center mt-5">Vagas encontradas</h2>
            <!-- Centralizar os cards e diminuir o espaçamento entre eles -->
            <div class="row d-flex justify-content-center mt-2">
                @foreach ($vagas as $vaga)
                @if($vaga->status == 'Sim')
                <div class="col-md-4 d-flex justify-content-center mb-3"> <!-- Diminuir o espaçamento entre os cards com 'mb-3' -->
                    <!-- Aumentar a largura dos cards -->
                    <div class="card" style="width: 400px;"> <!-- Aumentado para 400px -->
                        <div class="card-body card-body-home">
                            <h5 class="card-title">{{ $vaga->titulo }}</h5>
                            <div class="row">
                                <div class="col-md-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                                        <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z" />
                                    </svg>
                                </div>
                                <div class="col-md-9">
                                    <p class="card-text">{{ $vaga->unidade->descricao }}</p>
                                </div>
                            </div>
                            <!-- se não está autenticado, redireciona para o login -->
                            @if(Auth::check())
                            <a href="{{ route('candidatar.index', $vaga->id) }}" class="btn btn-principal mt-3"> Candidate-se</a>
                            @else
                            <a href="{{ route('login') }}" class="btn btn-principal mt-3"> Candidate-se</a>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
            <div class="footer">
                <center>
                    <img src="{{ asset('assets/2.png') }}" alt="Logo" class="img-logo-footer mb-5 mt-3">
                </center>

            </div>
        </div>
    </div>
</div>

<script>
    function updateDescription() {
        const select = document.getElementById('areaSelect');
        const selectedOption = select.options[select.selectedIndex];
        const descricao = selectedOption.getAttribute('data-descricao');

        // Atualiza o campo de descrição com base na seleção
        document.getElementById('areaDescricao').value = descricao;
    }

    // Definir a descrição inicial com base na primeira opção
    window.onload = function() {
        updateDescription();
    };
</script>

@endsection