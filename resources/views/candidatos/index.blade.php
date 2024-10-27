@extends('layouts.app')
@extends('general')

@section('content')

<div class="container">
    <div class="row justify-content-center p-5">
        <div class="col-md-12">
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
                <h2 class="mb-0">Candidatos</h2>
                
                    @php
                        $cards = [
                            ['title' => 'Bando de talentos', 'description' => 'Visualize candidatos por áreas.', 'route' => 'bancoCurriculos.index'],
                            ['title' => 'Candidatos a vagas', 'description' => 'Visualize os candidatos para vagas abertas.', 'route' => 'vaga.index'],
                           
                        ];
                    @endphp

                    <div class="row d-flex justify-content-center mt-3">
                        <div class="row d-flex justify-content"> <!-- Linha para os cards de gerenciamento das vagas -->
                            @foreach ($cards as $card)
                                <div class="col-md-4 mb-3"> <!-- Coluna com 4 unidades de largura para 3 colunas -->
                                    <div class="card-cadastro"> 
                                        <div class="card-body card-body-home" style="position: relative;">
                                            <h5 class="card-title">{{ $card['title'] }}</h5>
                                            <p class="card-text">{{ $card['description'] }}</p>
                                            <a href="{{ route($card['route']) }}" class="btn btn-principal">Acessar</a>
                                        </div>
                                    </div>
                                </div>
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

<script>
   function toggleOrdem() {
    const ordemElements = document.querySelectorAll('.ordem');
    const isChecked = document.getElementById('toggle-sequencia').checked;
    ordemElements.forEach(element => {
        if (isChecked) {
            element.classList.remove('hidden'); // Mostra a sequência quando ativo
        } else {
            element.classList.add('hidden');    // Oculta a sequência quando inativo
        }
        });
    }

</script>
