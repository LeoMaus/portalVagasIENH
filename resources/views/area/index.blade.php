@extends('layouts.app')
@extends('general')

@section('content')

<div class="container">
  <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Exclusão</h5>
              <button type="button" id="closeModalButton" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Tem certeza de que deseja excluir esta área?
            </div>
            <div class="modal-footer">
              <button type="button" id="cancelButton" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <form id="deleteareaForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <button type="submit" id="confirmDeleteButton" class="btn btn-danger">Confirmar</button>
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
                  <h4>{{ __('Área de atuação') }}</h4>
              </div>
              <div class="col-md-3 mb-3"> 
                <a href="{{ route('area.create') }}" id="createNewAreaButton" class="btn btn-principal">Criar nova área</a>
              </div>
          </div>
          <div class="table-responsive col-md-12">
            <table class="table table-bordered" cellspacing="0" cellpadding="0">
              <thead>
                <tr>
                  <th>Nome</th>
                  <th>Descrição</th>
                  <th>Data Criação</th>
                  <th class="actions">Ações</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  @foreach ($areas as $area)
                  <td>{{ $area->nome }}</td>
                  <td>{{ $area->descricao }}</td>
                  <td>{{ $area->created_at }}</td>
                  <td class='actions'>
                    <a class='btn btn-warning btn-xs' id="editAreaButton_{{ $area->id }}" href="{{ route('area.edit', ['area' => $area->id]) }}">Editar</a>
                    <a class='btn btn-danger btn-xs delete-area-btn' id="deleteAreaButton_{{ $area->id }}" href='#' data-toggle='modal' data-target='#confirmDeleteModal' data-url="{{ route('area.destroy', ['area' => $area->id]) }}">Excluir</a>
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
        $(".delete-area-btn").click(function () {
          var url = $(this).data("url");
          $("#deleteareaForm").attr("action", url);
        });
    });
</script>

@endsection
