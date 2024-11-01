@extends('layouts.app')
@extends('general')

@section('content')

<div class="container">
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
              Tem certeza de que deseja excluir esta função?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <form id="deletefuncaoForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <button type="submit" id="confirm-delete-btn" class="btn btn-danger">Confirmar</button>
              </form>
            </div>
        </div>
    </div>
  </div>
  <br><br>
  
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

  <div class="row justify-content-center">
    <div class="col-md-12 mt-5">
      <div class="card">
        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
              {{ session('status') }}
          </div>
          @endif

          <div class="row">
              <div class="col-md-11">
                  <h4>{{ __('funções') }}</h4>
              </div>
              <div class="col-md-3 mb-3"> 
                <a href="{{ route('funcao.create') }}" id="create-funcao-btn" class="btn btn-principal">Criar nova função</a>
              </div>
          </div>
          <div class="table-responsive col-md-12">
            <table class="table table-bordered" cellspacing="0" cellpadding="0">
              <thead>
                <tr>
                  <th>Nome</th>
                  <th>Descrição</th>
                  <th>Responsabilidades</th>
                  <th>Data Criação</th>
                  <th class="actions">Ações</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                @foreach ($funcoes as $funcao)
                  <td>{{ $funcao->nome }}</td>
                  <td>{{ $funcao->descricao }}</td>
                  <td>{{ $funcao->responsabilidades }}</td>
                  <td>{{ $funcao->created_at }}</td>
                  <td class='actions'>
                    <a class='btn btn-warning btn-xs' href="{{ route('funcao.edit', ['funcao' => $funcao->id]) }}"><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Editar</a>
                    <a class='btn btn-danger btn-xs delete-funcao-btn' href='#' data-toggle='modal' data-target='#confirmDeleteModal' data-url="{{ route('funcao.destroy', ['funcao' => $funcao->id]) }}"><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Excluir</a>
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
        $(".delete-funcao-btn").click(function () {
          var url = $(this).data("url");
          $("#deletefuncaoForm").attr("action", url);
        });
    });
</script>

@endsection
