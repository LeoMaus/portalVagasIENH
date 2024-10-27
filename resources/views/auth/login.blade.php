@extends('layouts.app')
@extends('general')

@section('content')

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-text text-center mt-2">
                    <img src="{{ asset('assets/logo.jpg') }}" alt="Logo" class="img-logo">
                    <div class="text-center title-page">{{ __('Login') }}</div>
                </div>

                <div class="card-body p-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group mb-2">                          
                            <input id="email" type="email" class="form-control input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('Email') }}">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        
                        </div>

                        <div class="form-group">
                            <input id="password" type="password" class="form-control input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"    placeholder="{{ __('Senha') }}">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        
                        </div>

                        <div class="row mb-2">
                            <center>
                                <div class="col-md-8">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Recuperar senha') }}
                                        </a>
                                    @endif
                                </div>
                            </center>
                        </div>

                        <div class="row mb-0">
                            <center>
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-principal">
                                        {{ __('Acessar') }}
                                    </button>
                                </div>
                            </center>
                        </div>
                        <div class="row mb-0 mt-3">
                            <center>
                                <div class="col-md-8">
                                    <a href="{{ route('register') }}" class="btn btn-link-2">Cadastre-se</a>
                                </div>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
            <div>
                <center>
                    <img src="{{ asset('assets/2.png') }}" alt="Logo" class="img-logo-footer mb-5 mt-3">
                </center>
               
            </div>
        </div>
    </div>
</div>

@endsection
