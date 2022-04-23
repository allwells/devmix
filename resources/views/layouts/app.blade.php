<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DevMix</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/trix.css') }}">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body style="background-color: #010101; min-height: 100vh;">
    <nav style="margin-bottom: 30px; border-bottom: 1px solid #333; position: fixed; width: 100%; background-color: #171717;"
        class="navbar navbar-expand-lg navbar-dark px-5">
        <div class="container-fluid">
            {{-- logo --}}
            <a class="navbar-brand fw-bolder" href="@auth {{ route('dashboard') }} @endauth
                @guest {{ route('posts') }} @endguest">
                dev.Mix()
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex justify-content-end w-auto" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    @guest
                        {{-- Home route --}}
                        <li class="nav-item d-flex flex-column justify-content-center">
                            <a class="nav-link text-light" href="{{ route('posts') }}" tabindex="-1" aria-disabled="true">
                                <img src="{{ asset('img/home.svg') }}" width="25" height="25" alt="home" />
                                <span style="font-size: 14px; margin-left: 0.2rem;" class="text-light fw-bold">Home</span>
                            </a>
                        </li>
                    @endguest

                    @auth
                        {{-- Explore route --}}
                        <li class="nav-item d-flex flex-column justify-content-center">
                            <a class="nav-link text-light" href="{{ route('posts') }}" tabindex="-1" aria-disabled="true">
                                <img src="{{ asset('img/explore.svg') }}" width="25" height="25" alt="explore" />
                                <span style="font-size: 14px; margin-left: 0.2rem;"
                                    class="text-light fw-bold">Explore</span>
                            </a>
                        </li>

                        {{-- Dashboard route --}}
                        <li class="nav-item d-flex flex-column justify-content-center">
                            <a class="nav-link text-light" href="{{ route('dashboard') }}" tabindex="-1"
                                aria-disabled="true">
                                <img src="{{ asset('img/dashboard.svg') }}" width="25" height="25" alt="dashboard" />
                                <span style="font-size: 14px; margin-left: 0.2rem;"
                                    class="text-light fw-bold">Dashboard</span>
                            </a>
                        </li>
                    @endauth

                    @guest
                        {{-- Login button --}}
                        <li class="nav-item d-flex flex-column justify-content-center">
                            <a class="nav-link text-light" href="{{ route('login') }}" tabindex="-1"
                                aria-disabled="true">
                                <img src="{{ asset('img/login.svg') }}" width="25" height="25" alt="login" />
                                <span style="font-size: 14px; margin-left: 0.2rem;" class="text-light fw-bold">Login</span>
                            </a>
                        </li>

                        {{-- register button --}}
                        <li class="nav-item d-flex flex-column justify-content-center">
                            <a class="nav-link text-light" href="{{ route('register') }}" tabindex="-1"
                                aria-disabled="true">
                                <img src="{{ asset('img/register.svg') }}" width="25" height="25" alt="register" />
                                <span style="font-size: 14px; margin-left: 0.2rem;"
                                    class="text-light fw-bold">Register</span>
                            </a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    @yield('scripts')
    <footer
        style="background-color: #000; font-size: 13px; color: #888; position: fixed; bottom: 0; cursor: default; border-top: 1px solid #222;"
        class="d-flex justify-content-center w-100 align-items-center py-2">
        Posty © 2022. Made with
        <img class="mx-1" src="{{ asset('img/like.svg') }}" width="20" height="20" alt="love" />
        by <a class="mx-1 fw-bold" href="http://github.com/allwells" target="_blank"
            rel="noopener noreferrer">Allwell</a>
    </footer>

</body>

</html>
