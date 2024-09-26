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
              Tem certeza de que deseja excluir esta cargo?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <form id="deletecargoForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Confirmar</button>
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
                  <h4>  {{ __('Cargos') }}</h4>
              </div>
              <div class="col-md-3 mb-3"> 
                <a href="{{ route('cargo.create') }}" class="btn btn-principal" >Criar nova cargo</a>
              </div>
          </div>
          <div class="table-responsive col-md-12">
            <table class="table table-bordered" cellspacing="0" cellpadding="0">
              <thead>
                <tr>
                  <th>Nome</th>
                  <th>Descrição</th>
                  <th>Responsabilidades</th>
                  <th>Área ID</th>
                  <th>Data Criação</th>

                  <th class="actions">Ações</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  @foreach ($cargos as $cargo)
                  <td>{{ $cargo->nome }} </td>
                  <td>{{ $cargo->descricao }}</td>
                  <td>{{ $cargo->responsabilidades }}</d>
                  <td>{{ $cargo->area_id }}</td>
                  <td>{{$cargo->created_at}}</td>
                  <td class='actions'>
                    <a class='btn btn-warning btn-xs' href="{{ route('cargo.edit', ['cargo' => $cargo->id]) }}"><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Editar</a>
                    <a class='btn btn-danger btn-xs delete-cargo-btn' href='#' data-toggle='modal' data-target='#confirmDeleteModal' data-url="{{ route('cargo.destroy', ['cargo' => $cargo->id]) }}"><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Excluir</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
  </div>
</div>

<script>
    $(document).ready(function () {
        $(".delete-cargo-btn").click(function () {
          var url = $(this).data("url");
          $("#deletecargoForm").attr("action", url);
        });
    });
</script>

@endsection
