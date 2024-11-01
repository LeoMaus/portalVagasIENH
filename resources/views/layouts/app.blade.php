<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Include Bootstrap CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.min.js"></script>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="@if (!Route::is('login') && !Route::is('register') && !Route::is('password.request')) background-interno @else background @endif">

    <div id="app">
        <!-- Condicional para exibir o nav apenas se a rota não for login -->
        @if (!Route::is('login'))
        @if (!Route::is('register'))
        @if (!Route::is('password.request'))

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <img src="{{ asset('assets/logo.jpg') }}" alt="Logo" class="img-logo-interna">
                </a>
                <button id="navbar-toggler" class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registre-se') }}</a>
                        </li>
                        @endif
                        @else
                        @auth
                        @if(Auth::user()->role == 'admin')
                        <!-- Menu usuário administrador -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cadastros.index') }}">{{ __('Cadastros') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('candidatos.index') }}">{{ __('Candidatos') }}</a>
                        </li>
                        <!-- Fim menu usuário administrador -->
                        @endif

                        @if(Auth::user()->role == 'user')
                        <!-- Menu usuário padrão -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('candidato.show') }}">{{ __('Minhas vagas') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('area.show') }}">{{ __('Áreas de interesse') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/home') }}">{{ __('Vagas') }}</a>
                        </li>
                        <!-- Fim menu usuário padrão -->
                        @endif
                        @endauth

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('profile') }}" onclick="event.preventDefault();
                                document.getElementById('profile-form').submit();">
                                    {{ __('Perfil') }}
                                </a>
                                <form id="profile-form" action="{{ route('profile') }}" method="GET" class="d-none">
                                    @csrf
                                </form>

                                <a class="dropdown-item" href="{{ route('home') }}" onclick="event.preventDefault();
                                                    document.getElementById('home-form').submit();">
                                    {{ __('Home') }}
                                </a>
                                <form id="home-form" action="{{ route('home') }}" method="GET" class="d-none">
                                    @csrf
                                </form>
                                
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @endif
        @endif
        @endif

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
