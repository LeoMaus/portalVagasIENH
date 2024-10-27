@extends('layouts.app')
@extends('general')

@section('content')

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-text text-center  mt-2">
                    <img src="{{ asset('assets/logo.jpg') }}" alt="Logo" class="img-logo">
                    <div class="text-center title-page">{{ __('Cadastre-se') }}</div>
                </div>

                <div class="card-body p-5">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group mb-2">
                            <input id="name" type="text" class="form-control input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="{{ __('Nome') }}">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        
                        </div>

                        <div class="form-group mb-2">
                            <input id="email" type="email" class="form-control input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('Email') }}">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        
                        </div>

                        <div class="form-group mb-2">
                            <input id="password" type="password" class="form-control input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{ __('Senha') }}">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        
                        </div>

                        <div class="form-group mb-4">
                            <input id="password-confirm" type="password" class="form-control input" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Confirmação da senha') }}">
                        </div>

                        <div class="form-group mb-2">
                            <center>
                                <button type="submit" class="btn btn-principal">
                                    {{ __('Registrar') }}
                                </button>
                            </center>
                        </div>
                    </form>
                </div>
                <div>
                    <center>
                        <img src="{{ asset('assets/2.png') }}" alt="Logo" class="img-logo-footer mb-5 mt-3">
                    </center>
                   
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
