@extends('layouts.app')
@extends('general')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="row mb-3">
                        <div class="col-md-9">
                            <h4>{{ __('Adicionar usuário') }}</h4>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('create') }}">
                        @csrf

                        <div class="form-group mb-2">
                            <label for="name">{{ __('Nome') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="email">{{ __('Email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-row">
                            <!-- Tipo de Pessoa -->
                            <div class="col mb-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pf_pj" id="inlineRadio1" value="PF" required onchange="toggleCpfCnpj()">
                                    <label class="form-check-label" for="inlineRadio1">Pessoa Física</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pf_pj" id="inlineRadio2" value="PJ" required onchange="toggleCpfCnpj()">
                                    <label class="form-check-label" for="inlineRadio2">Pessoa Jurídica</label>
                                </div>
                            </div>

                            <!-- Campo CPF/CNPJ -->
                            <div class="col mb-3" id="cpfCnpjContainer" style="display:none;">
                                <label for="cpfCnpjInput" id="cpfCnpjLabel">CPF</label>
                                <input id="cpfCnpjInput" type="text" class="form-control" name="cpf_cnpj" placeholder="Digite seu CPF">
                            </div>
                        </div>

                        <div class="form-group mb-2">
                            <label for="password">{{ __('Senha') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="password-confirm">{{ __('Confirmação da senha') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" value="admin" id="role" for="role" name="role">
                        <label class="form-check-label" for="flexCheckDefault">
                                Administrador
                            </label>
                        </div>

                        <div class="form-group mb-2">
                            <center>
                                <a type="button" href="{{route('users')}}" class="btn btn-secondary" id="backButton">
                                    {{ __('Voltar') }}
                                </a>
                                <button type="submit" id="saveButton" class="btn btn-principal">
                                    {{ __('Salvar') }}
                                </button>
                            </center>
                        </div>
                    </form>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
   function toggleCpfCnpj() {
        const pfCnpjContainer = document.getElementById('cpfCnpjContainer');
        const cpfCnpjLabel = document.getElementById('cpfCnpjLabel');
        const cpfCnpjInput = document.getElementById('cpfCnpjInput');

        // Verifica qual rádio está selecionado
        const selectedValue = document.querySelector('input[name="pf_pj"]:checked').value;
        
        if (selectedValue === 'PJ') {
            pfCnpjContainer.style.display = 'block'; // Mostra o campo
            cpfCnpjLabel.textContent = 'CNPJ'; // Atualiza o rótulo para CNPJ
            cpfCnpjInput.placeholder = 'Digite seu CNPJ'; // Atualiza o placeholder
            $(cpfCnpjInput).mask('99.999.999/9999-99'); // Aplica a máscara de CNPJ
        } else {
            pfCnpjContainer.style.display = 'block'; // Mostra o campo
            cpfCnpjLabel.textContent = 'CPF'; // Atualiza o rótulo para CPF
            cpfCnpjInput.placeholder = 'Digite seu CPF'; // Atualiza o placeholder
            $(cpfCnpjInput).mask('999.999.999-99'); // Aplica a máscara de CPF
        }
    }
</script>