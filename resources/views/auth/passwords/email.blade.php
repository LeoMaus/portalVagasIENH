@extends('layouts.app')
@extends('general')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
            <div class="card">
            <div class="card-text text-center  mt-2">
                    <img src="{{ asset('assets/1.png') }}" alt="Logo" class="img-logo">
                    <div class="text-center" style="font-size: 18px">{{ __('Recuperar senha') }}</div>
                </div>
                <div class="card-body p-5">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group mb-2">
                            <label for="email">{{ __('Endereço de Email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                        </div>

                        <div class="row mb-0 mt-4">
                            <center>
                                <button type="submit" class="btn btn-principal">
                                    {{ __('Recuperar senha') }}
                                </button>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
