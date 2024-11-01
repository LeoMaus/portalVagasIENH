@extends('layouts.app')
@extends('general')

@section('content')

<div class="container">
  <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Exclusão</h5>
              <button id="closeModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Tem certeza de que deseja excluir esta vaga?
            </div>
            <div class="modal-footer">
              <button id="cancelDelete" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <form id="deleteVagaForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <button id="confirmDelete" type="submit" class="btn btn-danger">Confirmar</button>
              </form>
            </div>
        </div>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col-md-12 mt-5">
      <div class="card">
        <div class="card-body">
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

          <div class="row">
              <div class="col-md-11">
                  <h4>{{ __('Vagas') }}</h4>
              </div>
              <div class="col-md-3 mb-3"> 
                <a href="{{ route('vaga.create') }}" class="btn btn-principal" >Criar nova vaga</a>
              </div>
          </div>
          <div class="table-responsive col-md-12">
            <table class="table table-bordered" cellspacing="0" cellpadding="0">
              <thead>
                <tr>
                  <th>Título</th>
                  <th>Unidade</th>
                  <th>Descrição</th>
                  <th>Ativo</th>
                  <th>Início vigência</th>
                  <th>Término vigência</th>
                  <th>Prazo contratação</th>
                  <th>Salário</th>
                  <th class="actions">Ações</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($vagas as $vaga)
                  <td>{{ $vaga->titulo }} </td>
                  <td>{{ $vaga->unidade->descricao }}</td>
                  <td>{{ $vaga->descricao }}</td>
                  <td>{{ $vaga->status }}</td>
                  <td>{{ \Carbon\Carbon::parse($vaga->data_inicio_vigencia)->format('d/m/y') }}</td>
                  <td>{{ \Carbon\Carbon::parse($vaga->data_termino_vigencia)->format('d/m/y') }}</td>
                  <td>{{ \Carbon\Carbon::parse($vaga->prazo_contratacao)->format('d/m/y') }}</td>
                  <td>{{$vaga->salario}}</td>
                  <td class='actions'>
                    <a class='btn btn-warning btn-xs' href="{{ route('vaga.edit', ['vaga' => $vaga->id]) }}"><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Editar</a>
                    <a class='btn btn-danger btn-xs delete-vaga-btn' href='#' data-toggle='modal' data-target='#confirmDeleteModal' data-url="{{ route('vaga.destroy', ['vaga' => $vaga->id]) }}"><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Excluir</a>
                    <a class='btn btn-success btn-xs' href="{{ route('curriculosVaga.index', $vaga->id) }}">Candidatos</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
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

<script>
    $(document).ready(function () {
        $(".delete-vaga-btn").click(function () {
          var url = $(this).data("url");
          $("#deleteVagaForm").attr("action", url);
        });
    });
</script>

@endsection
