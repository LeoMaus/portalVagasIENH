<!-- Modal de Confirmação de Exclusão -->
<div class="modal fade" id="confirmDeleteModalFuncao" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
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
                <form id="deleteFuncaoForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Confirmar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Tela de Listagem de Funções -->
<div class="row justify-content-center">
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-10">
                <h4>{{ __('Funções') }}</h4>
            </div>
            <div class="col-md-3 mb-3">
                <a href="{{ route('funcao.form') }}" class="btn btn-principal">Inserir nova função</a>
            </div>
        </div>
        <div class="table-responsive col-md-12">
            <table class="table table-bordered" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Responsabilidades</th>
                        <th class="actions">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($funcoes as $funcao)
                        <tr>
                            <td>{{ $funcao->id }}</td>
                            <td>{{ $funcao->nome }}</td>
                            <td>{{ $funcao->descricao }}</td>
                            <td>{{ $funcao->responsabilidades }}</td>
                            <td class='actions'>
                                <a class='btn btn-warning btn-xs' href="{{ route('funcao.edit', ['funcao' => $funcao->id]) }}">
                                    <span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Editar
                                </a>
                                <a class='btn btn-danger btn-xs delete-funcao-btn' href='#' data-toggle='modal' data-target='#confirmDeleteModalFuncao' data-url="{{ route('funcao.destroy', ['funcao' => $funcao->id]) }}">
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

<script>
    $(document).ready(function () {
        $(".delete-funcao-btn").click(function () {
            var url = $(this).data("url");
            $("#deleteFuncaoForm").attr("action", url);
        });
    });
</script>
