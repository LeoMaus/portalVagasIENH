@extends('layouts.app')
@extends('general')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-9">
                            <h4>{{ $pergunta->pergunta }}</h4>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <strong>Resposta em texto livre: </strong>{{ $pergunta->freeText ? 'Sim' : 'Não' }}
                    </div>

                    @if(!$pergunta->freeText)
                        <div class="form-group mb-2 mt-3">
                            <div id='opt_resp'>
                                <strong>Permite múltiplas respostas: </strong>{{ $pergunta->mult_resps ? 'Sim' : 'Não' }}
                                <br>
                                <strong>Opções de Resposta:</strong>
                                <ul>
                                    @foreach($pergunta->optionsList as $option)
                                        <li>{{ $option }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <div class="form-group mb-2 mt-3">
                        <strong>Cargos Vinculados:</strong>
                        <ul>
                            @foreach ($pergunta->cargos as $cargo)
                                <li>{{ $cargo->nome }}</li>
                            @endforeach
                        </ul>
                    </div>

                    @isnotnull($respostas)
                        <div class="form-group mb-2 mt-3">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <td>Respostas</td>
                                        <td>Quantidade</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($respostas as $resposta)
                                        <tr>
                                            <td>{{ $resposta->resposta }}</td>
                                            <td>{{ $resposta->qtde }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <h6>Ninguém respondeu essa pergunta ainda</h6>
                    @endisnotnull

                    <div class="form-group mb-2">
                        <center>
                            <a type="button" id="voltarButton" href="{{route('pergunta.index')}}" class="btn btn-secondary">Voltar</a>
                            <a type="button" id="editarButton" href="{{route('pergunta.edit', ['pergunta' => $pergunta->id])}}" class="btn btn-secondary">Editar</a>
                        </center>
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
