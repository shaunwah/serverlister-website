<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="minecraft, minecraft asia, minecraft singapore, minecraft server, minecraft servers, best minecraft server, best minecraft servers, server list, best server list, top server list, top list">
    <meta name="robots" content="@yield('meta_robots', 'index, follow')">

    <meta name="og:type" content="website">
    <meta name="og:site_name" content="ServerLister">
    <meta name="og:title" content="@yield('title', 'Page')">
    <meta name="og:url" content="{{ url()->current() }}">

    <link rel="canonical" href="{{ secure_url(url()->current()) }}">

    @yield('header')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Page') - ServerLister</title>

    {{-- Global site tag (gtag.js) - Google Analytics --}}
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-142060979-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-142060979-1');
        @auth
            gtag('set', {'user_id': '{{ auth()->id() }}'});
        @endauth
    </script>

    <script defer src="https://kit.fontawesome.com/ef9f9fad9d.js"></script>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

</head>
<body>
    <div id="app">

        {{-- Navbar --}}
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}"><i class="fal fa-server"></i></a>
                <button class="navbar-toggler pr-0 border-0" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav mr-auto">
                            <a class="nav-item nav-link" href="{{ route('home') }}">Home {{-- <span class="sr-only">(current)</span> --}}</a>
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
                                    <a class="dropdown-item" href="{{ route('dashboard') }}"><i class="fal fa-columns fa-fw"></i> {{ __('Dashboard') }}</a>
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

        <main role="main" class="py-4">

            @yield('content')

        </main>

        {{-- Footer --}}
        <footer class="footer mt-auto">
            <div class="container-fluid" style="background-color: hsl(0, 0%, 25%);">
                <div class="container px-0 px-sm-3 py-4 text-white">
                    <div class="row align-items-top mb-3">
                        <div class="col-12 col-sm-auto mr-auto">
                            <h3>ServerLister</h3>
                            <p class="text-white-50">
                                Crafted with love in Singapore<br>
                                Copyright &copy; Zodurus Labs
                            </p>
                        </div>
                        <div class="col-auto col-sm-2">
                            <h5 class="font-weight-bold text-white-50">Popular Servers</h5>
                            <ul class="list-unstyled text-truncate">
                                @foreach(App\Server::orderBy('rank', 'asc')->paginate(5) as $server)
                                    <li><a href="{{ route('servers.show', $server->id) }}" class="text-reset">{{ $server->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-auto col-sm-2">
                            <h5 class="font-weight-bold text-white-50">New Servers</h5>
                            <ul class="list-unstyled text-truncate">
                                @foreach(App\Server::orderBy('created_at', 'desc')->paginate(5) as $server)
                                    <li><a href="{{ route('servers.show', $server->id) }}" class="text-reset">{{ $server->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div>
                        <ul class="list-inline text-white-50">
                            <li class="list-inline-item"><a href="{{ url('/support/privacy-policy') }}" class="text-reset">{{ __('Privacy Policy') }}</a></li>
                            <li class="list-inline-item"><a href="{{ url('/support/terms-of-service') }}" class="text-reset">{{ __('Terms of Service') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    {{-- Scripts --}}
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    @yield('scripts')

</body>
</html>
