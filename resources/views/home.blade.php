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

<<<<<<< HEAD
    <!-- Centralizar os cards e diminuir o espaçamento entre eles -->
    <div class="row d-flex justify-content-center mt-5">
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
                                <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                            </svg>
                        </div>
                        <div class="col-md-9">
                            <p class="card-text">{{ $vaga->unidade->descricao }}</p>
                        </div>
                    </div>
                    @if(Auth::user()->role == 'user')
                    <a href="{{ route('candidatar.index', $vaga->id ) }}" class="btn btn-principal mt-3">Candidate-se</a>
                    @endif
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
        @if(Auth::user()->role == 'user')

=======
    @if(Auth::user()->role == 'user')
>>>>>>> 4ad8c1e8965e598c4e7b6237203565564355c19f
    <div class="row d-flex justify-content-center mt-5">
        <div class="col-md-12">
            <h2 class="text-center ">Confira as oportunidades</h2>
        </div>
    </div>
    <div class="row d-flex justify-content-center mt-4">

        <div class="col-md-8">           
            <div class="card bg-light shadow-sm">
                <div class="card-body">
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
                    <h5 class="card-title text-center">Selecione a Área</h5>
                    <form method="POST" action="{{ route('area.interesseArea') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="areaSelect" class="form-label">Área de Atuação</label>
                        <select id="areaSelect" name="area_id" class="form-select" onchange="updateDescription()" >
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}" data-descricao="{{ $area->descricao }}">{{ $area->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="areaDescricao" class="form-label">Descrição da Área</label>
                        <textarea class="form-control" id="areaDescricao" value="" readonly> </textarea>
                    </div>
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="text-center">
                            <button type="submit" class="btn btn-principal mt-3">Banco de Talentos</button>
                        </div>
                    </form>
                </div>
            </div>
            @endif

            <div class="row d-flex justify-content-center mt-5">
                <div class="col-md-12">
                    <h2 class="text-center ">Vagas encontradas</h2>
                </div>
            </div>
             <!-- Centralizar os cards e diminuir o espaçamento entre eles -->
            <div class="row d-flex justify-content-center mt-5">
                @foreach ($vagas as $vaga)
                @if($vaga->status == 'Aberta')
                <div class="col-md-4 d-flex justify-content-center mb-3"> <!-- Diminuir o espaçamento entre os cards com 'mb-3' -->
                    <!-- Aumentar a largura dos cards -->
                   
                    <h5 class="card-title">{{ $vaga->titulo }}</h5>
                    <div class="row">
                        <div class="col-md-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                                <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                            </svg>
                        </div>
                        <div class="col-md-9">
                            <p class="card-text">{{ $vaga->unidade->descricao }}</p>
                        </div>
                    </div>
                    @if(Auth::user()->role == 'user')
                    <a href="{{ route('candidatar.index', $vaga->id ) }}" class="btn btn-principal mt-3">Candidate-se</a>
                    @endif
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
