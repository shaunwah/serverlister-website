<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="minecraft, minecraft asia, minecraft singapore, minecraft server, minecraft servers, best minecraft server, best minecraft servers, server list, best server list, top server list, top list">
    <meta name="robots" content="index, follow">

    <meta name="og:type" content="webste">
    <meta name="og:site_name" content="ServerLister">
    <meta name="og:title" content="@yield('title', 'Page') - ServerLister">
    <meta name="og:url" content="{{ url()->current() }}">

    @yield('header')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Page') - ServerLister</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <script src="https://kit.fontawesome.com/ef9f9fad9d.js"></script>
</head>
<body>
    <div id="app">

        {{-- Navbar --}}
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}"><i class="fal fa-server"></i></a>
                <button class="navbar-toggler pr-0 border-0" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav mr-auto">
                            <a class="nav-item nav-link" href="{{ url('/') }}">Home {{-- <span class="sr-only">(current)</span> --}}</a>
                            <a class="nav-item nav-link" href="{{ route('servers.index') }}">Servers</a>
                            <a class="nav-item nav-link" href="{{ url('/support') }}">Support</a>
                    </div>
                    <div class="navbar-nav">
                        @guest
                            <a class="nav-item nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            @if (Route::has('register'))
                                <a class="nav-item nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->username }}</a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="{{ url('user/settings/account') }}"><i class="fal fa-cogs fa-fw"></i> {{ __('Settings') }}</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onClick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fal fa-sign-out-alt fa-fw"></i> {{ __('Logout') }}</a>
                                </div>
                            </li>
                            <form id="logout-form" method="post" action="{{ route('logout') }}" style="display:none;">
                                @csrf
                            </form>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>

        <main id="content" class="py-4">

            {{-- Alert --}}
            @if (session('alert'))
                <div class="container">
                    <div class="alert alert-{{ session('alert_colour', 'info') }} alert-dismissible show" role="alert">
                        <i class="fal fa-info-circle fa-fw"></i> {{ session('alert') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif

            @yield('content')

        </main>

        {{-- Footer --}}
        <div class="container">
            <footer class="mt-4 py-4 border-top">
                <div class="row align-items-center">
                    <div class="col-auto mr-auto">
                        <span class="text-muted">Crafted with <i class="fal fa-heart fa-sm"></i> in Singapore.</span>
                    </div>
                    <div class="col-auto">
                        <span class="font-weight-bold text-muted">Zodurus Labs</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    {{-- Scripts --}}
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    @yield('scripts')

</body>
</html>
