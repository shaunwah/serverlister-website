<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="@yield('meta_robots', 'index, follow')">
    <link rel="canonical" href="{{ secure_url(url()->current()) }}">
    @if (View::hasSection('meta_description'))
        <meta name="description" content="@yield('meta_description')">
    @endif
    <meta name="og:description" content="@yield('meta_description', 'ServerLister is a Minecraft server list that helps you find the best servers in the wild.')">
    <meta name="og:type" content="website">
    <meta name="og:site_name" content="ServerLister">
    <meta name="og:title" content="@yield('title', 'Page')">
    <meta name="og:url" content="{{ url()->current() }}">

    @yield('head')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Page') - ServerLister</title>

    {{-- Global site tag (gtag.js) - Google Analytics --}}
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-142060979-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-142060979-1');
    </script>

    <script src="https://kit.fontawesome.com/ef9f9fad9d.js"></script>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">

</head>
<body>
    <div id="app">
        <header>

            {{-- Navbar --}}
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('home') }}"><i class="fal fa-server"></i></a>
                    <button class="navbar-toggler pr-0 border-0" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav mr-auto">
                                <a class="nav-item nav-link" href="{{ route('home') }}">{{ __('text.headers.home') }} {{-- <span class="sr-only">(current)</span> --}}</a>
                                <a class="nav-item nav-link" href="{{ route('servers.index') }}">{{ __('text.headers.servers') }}</a>
                                <a class="nav-item nav-link" href="{{ url('/support') }}">{{ __('text.headers.support') }}</a>
                        </div>
                        <div class="navbar-nav">
                            @guest
                                <a class="nav-item nav-link" href="{{ route('login') }}">{{ __('text.user.headers.login') }}</a>
                                @if (Route::has('register'))
                                    <a class="nav-item nav-link" href="{{ route('register') }}">{{ __('text.user.headers.register') }}</a>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->username }}</a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item" href="{{ route('user.dashboard') }}"><i class="fal fa-columns fa-fw"></i> {{ __('text.user.headers.dashboard') }}</a>
                                        <a class="dropdown-item" href="{{ url('user/settings/account') }}"><i class="fal fa-cogs fa-fw"></i> {{ __('text.user.headers.settings') }}</a>
                                        <div class="dropdown-divider"></div>
                                        @if (auth()->id() == 1)
                                            <a class="dropdown-item" href="{{ route('console.dashboard') }}"><i class="fal fa-terminal fa-fw"></i> {{ __('text.user.headers.console') }}</a>
                                            <div class="dropdown-divider"></div>
                                        @endif
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

        </header>
        <main role="main" class="py-4">

            @yield('content')

        </main>

        {{-- Footer --}}
        <footer class="footer">
            <div class="container py-4 text-white">
                <div class="row align-items-top mb-3">
                    <div class="col-12 col-sm-auto mr-auto">
                        <h3>ServerLister</h3>
                        <p class="text-white-50">
                            {{ __('text.app.content.author') }}<br>
                            {!! __('text.app.content.copyright') !!}
                        </p>
                    </div>
                    <div class="col-auto col-sm-2">
                        <h5 class="font-weight-bold text-white-50">{{ __('text.servers.headers.top') }}</h5>
                        <ul class="list-unstyled text-truncate">
                            @foreach(App\Server::orderBy('rank', 'asc')->take(5)->get() as $server)
                                <li><a href="{{ route('servers.show', $server->id) }}" class="text-reset">{{ $server->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-auto col-sm-2">
                        <h5 class="font-weight-bold text-white-50">{{ __('text.servers.headers.new') }}</h5>
                        <ul class="list-unstyled text-truncate">
                            @foreach(App\Server::orderBy('created_at', 'desc')->take(5)->get() as $server)
                                <li><a href="{{ route('servers.show', $server->id) }}" class="text-reset">{{ $server->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div>
                    <ul class="list-inline mb-0 text-white-50">
                        <li class="list-inline-item"><a href="{{ url('/support/privacy-policy') }}" class="text-reset">{{ __('text.support.headers.privacy_policy') }}</a></li>
                        <li class="list-inline-item"><a href="{{ url('/support/terms-of-service') }}" class="text-reset">{{ __('text.support.headers.terms_of_service') }}</a></li>
                        <li class="list-inline-item"><a href="{{ url('/support/rules') }}" class="text-reset">{{ __('text.support.headers.rules') }}</a></li>
                    </ul>
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
