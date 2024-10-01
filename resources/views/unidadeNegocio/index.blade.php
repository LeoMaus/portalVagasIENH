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
              Tem certeza de que deseja excluir esta unidade de Negócio?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <form id="deleteunidadeNegocioForm" method="POST" action="">
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
                <h4>  {{ __('Unidade de Negócio') }}</h4>
            </div>
            <div class="col-md-3 mb-3"> 
              <a href="{{ route('unidadeNegocio.create') }}" class="btn btn-principal">Criar nova unidade de Negócio</a>
            </div>
          </div>

          <div class="table-responsive col-md-12">
            <table class="table table-bordered" cellspacing="0" cellpadding="0">
              <thead>
                <tr>
                  <th>Status</th>
                  <th>Descrição</th>
                  <th>Empresa</th>
                  <th>Unidade Pai</th>
                  <th>Responsável</th>
                  <th>Usuário Criação</th>
                  <th>Data Criação</th>
                  <th class="actions">Ações</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($unidadeNegocios as $unidadeNegocio)
                  <td>
                    <div class="p-2 rounded {{ $unidadeNegocio->ativo ? 'tag-success' : 'tag-danger' }}">
                      {{ $unidadeNegocio->ativo ? 'Ativo' : 'Inativo' }}
                    </div>
                  </td>
                  <td>{{ $unidadeNegocio->descricao }}</td>
                  <td>{{ $unidadeNegocio->users->name }}</td>
                  <td>{{ $unidadeNegocio->unidadePai ? $unidadeNegocio->unidadePai->descricao : '' }}</td>
                  <td>{{ $unidadeNegocio->responsavel->name }}</td>
                  <td>{{ $unidadeNegocio->usuarioCriacao->name }}</td>
                  <td>{{ $unidadeNegocio->created_at }}</td>
                  <td class='actions'>
                    <a class='btn btn-warning btn-xs' href="{{ route('unidadeNegocio.edit', ['unidadeNegocio' => $unidadeNegocio->id]) }}">
                      <span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Editar
                    </a>
                    <a class='btn btn-danger btn-xs delete-unidadeNegocio-btn' href='#' data-toggle='modal' data-target='#confirmDeleteModal' data-url="{{ route('unidadeNegocio.destroy', ['unidadeNegocio' => $unidadeNegocio->id]) }}">
                      <span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Excluir
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
</div>

<script>
    $(document).ready(function () {
        $(".delete-unidadeNegocio-btn").click(function () {
          var url = $(this).data("url");
          $("#deleteunidadeNegocioForm").attr("action", url);
        });
    });
</script>

@endsection
