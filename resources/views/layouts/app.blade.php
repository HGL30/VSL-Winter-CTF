<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>VSL Winter CTF 2024</title>
    <link rel="icon" type="image/png" href="{{ asset('Photo/favicon-32x32.png') }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!--  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <style>
        body {
            display: flex;
            flex-direction: column;
            background-color: white !important;
        }
        .bg-blue {
            background-color: purple !important;
        }

        .navbar-brand, .navbar-nav .nav-link {
            color: #ffffff !important;
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light bg-blue shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}" style="font-size: 24px; font-weight: bold;">
                VSLCTF
            </a>
            <a class="navbar-brand" href="{{ route('rule') }}">
                Rules
            </a>
            <a class="navbar-brand" href="{{ route('users') }}">
                Users
            </a>
            <a class="navbar-brand" href="{{ route('teams') }}">
                Teams
            </a>
            <a class="navbar-brand" href="{{ route('practices') }}">
                Practices
            </a>
            <a class="navbar-brand" href="{{ route('challenges') }}">
                Challenges
            </a>
            <a class="navbar-brand" href="{{ route('scoreboards') }}">
                Scoreboards
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li>
                            <a class="navbar-brand" href="{{ route('users.user', Auth::user()->name) }}">
                            <i class="fa-solid fa-address-card" style="color: #ffffff;"></i> Profile
                            </a>
                        </li>
                        <li>
                            <a class="navbar-brand" href="{{ route('teams.team') }}">
                            <i class="fa-solid fa-user-group" style="color: #ffffff;"></i> Team
                            </a>
                        </li>
                        @if(auth()->user()->isAdmin())
                            <li>
                                <a class="navbar-brand" href="{{ route('admin.admin') }}">
                                <i class="fa-solid fa-lock" style="color: #ffffff;"></i> AdminPanel
                                </a>
                            </li>
                        @endif
                        <li>
                            <a class="navbar-brand" style="text-decoration: none; color: white;" href="{{ route('users.setting') }}">
                                <i class="fa-solid fa-gear" style="color: #ffffff;"></i> {{ __('Settings') }}
                            </a>
                        </li>
                        <li>
                            <a class="navbar-brand" style="text-decoration: none; color: white;" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }} <i class="fa-solid fa-arrow-right-from-bracket" style="color: #ffffff;"></i>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                        <!-- <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" style="text-decoration: none; color: purple; background-color: #ffffff;" href="{{ route('users.setting') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                                </svg> {{ __('Settings') }}
                                </a>
                                <a class="dropdown-item" style="text-decoration: none; color: purple; background-color: #ffffff;" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/>
                                        <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
                                    </svg> {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li> -->
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="pt-4" style="min-height: 1200px; background-color: white;">
        @yield('content')
    </div>
    <div>
        @extends('layouts.footer')
    </div>
</body>
</html>
