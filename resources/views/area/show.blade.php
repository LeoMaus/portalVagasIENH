@extends('layouts.app')
@extends('general')

@section('content')
<div class="container">
  <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar cancelamento de interesse</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Tem certeza de que cancelar o seu interesse nesta área?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <form id="deleteInteresseForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Confirmar</button>
              </form>
            </div>
        </div>
    </div>
  </div>

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
              <div class="col-md-11">
                  <h4>  {{ __('Banco de talentos') }}</h4>
              </div>
          </div>
          <div class="table-responsive col-md-12">
            <table class="table table-bordered" cellspacing="0" cellpadding="0">
              <thead>
                <tr>
                  <th>Nome</th>
                  <th>Área de interesse</th>
                  <th>Descrição</th>

                  <th class="actions">Ações</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($userArea as $area)
                <tr>
                  <td>{{ $area->user->name }} </td>
                  <td>{{ $area->area->nome }}</td>
                  <td>{{ $area->area->descricao }}</td>                 
                  <td class='actions'>
                    <a class='btn btn-danger btn-sm delete-interesse-btn' href='#' data-toggle='modal' data-target='#confirmDeleteModal' data-url="{{ route('area.interesse.cancel', ['area' => $area->area_id]) }}">
                        <span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Cancelar interesse
                    </a>                  
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
        $(".delete-interesse-btn").click(function () {
          var url = $(this).data("url");
          $("#deleteInteresseForm").attr("action", url);
        });
    });
</script>

@endsection