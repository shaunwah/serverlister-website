@extends('layouts.app')
@section('header')
<meta name="description" content="ServerLister helps you to find the best Minecraft servers out there.">
<meta name="og:description" content="ServerLister helps you to find the best Minecraft servers out there.">
@endsection
@section('title', __('Welcome'))
@section('content')
{{-- Hero --}}
<div id="intro-hero-wrapper">
    <div class="container-fluid mt-n4 mb-3" id="intro-hero">
        <div class="container px-0 px-sm-3 py-4">
            <div class="row align-items-center mb-3 mb-md-0">
                <div class="col-auto mr-auto">
                    <h1 class="font-weight-bold text-white">ServerLister</h1>
                    <p class="lead text-white">
                        Tracking Minecraft servers worldwide, 24/7.
                    </p>
                </div>
                <div class="col-auto">
                    <a class="btn btn-outline-light btn-lg" href="{{ route('servers.index') }}" role="button">Find Servers <i class="fal fa-arrow-right fa-fw"></i></a>
                </div>
            </div>

            {{-- Top Servers --}}
            <div>
                <h2 class="text-white">Top Servers</h2>
                @foreach ($servers->sortBy('rank')->take(3) as $server)
                    <div class="card bg-dark text-white {{ !$loop->last ? 'mb-3' : '' }} {{ @$server->pings->last()->status == 1 ? 'shift-server-card-online' : 'shift-server-card-offline' }} shadow-none">
                        <div class="card-body px-3 py-1">
                            <div class="row no-gutters align-items-center">
                                <div class="d-none d-sm-block col-sm-1 text-left">
                                    <i class="fal fa-hashtag fa-fw"></i> {{ number_format($server->rank) }}
                                </div>
                                <div class="col-3 col-sm-2 col-md-1 text-left text-md-center">
                                    <img src="{{ asset($server->favicon) }}" class="rounded" alt="Favicon" height="48px" width="48px">
                                </div>
                                <div class="col-6 col-sm-7 col-md-8 text-left text-truncate">
                                    <span class="flag-icon {{ 'flag-icon-' . strtolower($server->country->code) }}"></span>
                                    <a class="font-weight-bold" href="{{ route('servers.show', $server->id) }}">{{ $server->name }}</a>
                                    <span class="text-white-50">{{ $server->version->name }}</span>
                                    <span class="d-block">{{ $server->host . ($server->port != 25565 ? ':' . $server->port : '') }}</span>
                                </div>
                                <div class="col-3 col-sm-2 text-right">
                                    @if (@$server->pings->last()->status == 1)
                                        {{ number_format(@$server->pings->last()->players_current) }} <i class="fal fa-users fa-fw"></i>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- New Servers --}}
            <div class="mb-3">
                <h2 class="mt-3 text-white">New Servers</h2>
                @foreach ($servers->sortByDesc('created_at')->take(3) as $server)
                    <div class="card bg-dark text-white {{ !$loop->last ? 'mb-3' : '' }} {{ @$server->pings->last()->status == 1 ? 'shift-server-card-online' : 'shift-server-card-offline' }} shadow-none">
                        <div class="card-body px-3 py-1">
                            <div class="row no-gutters align-items-center">
                                <div class="d-none d-sm-block col-sm-1 text-left">
                                    <i class="fal fa-hashtag fa-fw"></i> {{ number_format($server->rank) }}
                                </div>
                                <div class="col-3 col-sm-2 col-md-1 text-left text-md-center">
                                    <img src="{{ asset($server->favicon) }}" class="rounded" alt="Favicon" height="48px" width="48px">
                                </div>
                                <div class="col-6 col-sm-7 col-md-8 text-left text-truncate">
                                    <span class="flag-icon {{ 'flag-icon-' . strtolower($server->country->code) }}"></span>
                                    <a class="font-weight-bold" href="{{ route('servers.show', $server->id) }}">{{ $server->name }}</a>
                                    <span class="text-white-50">{{ $server->version->name }}</span>
                                    <span class="d-block">{{ $server->host . ($server->port != 25565 ? ':' . $server->port : '') }}</span>
                                </div>
                                <div class="col-3 col-sm-2 text-right">
                                    @if (@$server->pings->last()->status == 1)
                                        {{ number_format(@$server->pings->last()->players_current) }} <i class="fal fa-users fa-fw"></i>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <small class="text-white-50">
                Server data last updated {{ Carbon\Carbon::parse($servers->sortBy('rank', 'asc')->first()->pings->last()->created_at)->diffForHumans() }}
            </small>
        </div>
    </div>
</div>

{{-- Statistics Section --}}
<div class="container">
    <h2 class="font-weight-bold">Statistics</h2>
    <div class="card-deck">
        <div class="card">
            <div class="card-body">
                <span class="fa-stack fa-2x align-middle">
                    <i class="fas fa-circle fa-stack-2x text-dark"></i>
                    <i class="fal fa-server fa-stack-1x fa-inverse"></i>
                </span>
                <h3 class="card-title d-inline-block mb-0 align-middle">{{ number_format($servers->count()) }}<small class="d-block text-muted">Servers</small></h3>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <span class="fa-stack fa-2x align-middle">
                    <i class="fas fa-circle fa-stack-2x text-dark"></i>
                    <i class="fal fa-users fa-stack-1x fa-inverse"></i>
                </span>
                <h3 class="card-title d-inline-block mb-0 align-middle ">{{ number_format(App\ServerPing::pluck('players_current', 'server_id')->sum()) }}<small class="d-block text-muted">Players</small></h3>
            </div>
        </div>
    </div>
</div>
<hr>

{{-- FAQs Section --}}
<div class="container">
    <h2 class="font-weight-bold">FAQs</h2>
    <h3>What is ServerLister?</h3>
    <p>
        ServerLister is a Minecraft server list made to help you find the best Minecraft servers in the wild. We make use of multiple
        factors to help you find a quality server, including having a server scoring system that determines a server's quality.
    </p>

    <h3>What is this server scoring system?</h3>
    <p>
        The server scoring system takes into account its uptime, player count, vote count, and other server trend datasets and churns out a number based on an algorithm.
        The higher the score, the higher the determined quality of a server. This algorithm is calibrated regularly to help accurately identify quality servers.
    </p>

    <h3>What are votes?</h3>
    <p>
        Votes help indicate a server's popularity. The higher the votes a server has, the more popular a server is. Some servers have a voting rewards system in place,
        granting you a reward in return for voting for the server.
    </p>
    <p>
        If a server has a voting rewards system in place, it will usually be indicated in the server's vote page with text displaying <span class="font-italic">"You may receive a reward for voting."</span> to
        let you know that you may receive a reward upon voting. You may have to log in to the server for the first time to receive it.
    </p>

    <h3>How do I list my server?</h3>
    <p>
        You can create a server by navigating to the <a href="{{ route('servers.index') }}">servers page</a> after <a href="{{ route('register') }}">creating a ServerLister account</a>. The creation process
        takes less than five minutes so you can have your server listing up in no time!
    </p>
    <p>
        Our system only supports NuVotifier version 2 tokens. Your tokens are encrypted using OpenSSL (AES-256) and stored securely in our databases.
    </p>

    <h3>What if my server has already been listed?</h3>
    <p>
        ServerLister occasionally lists noteworthy servers from other Minecraft server lists on its website. You may request for a server takeover through
        our <a href="{{ url('//discordapp.com/invite/nzqRgUw') }}" target="_blank">Discord server</a>. We are working on an automated server takeover system at the moment
        through MOTD verification.
    </p>

    <h3>Where can I provide feedback?</h3>
    <p>
        We are currently in development and would love to hear from you. You may provide your valuable feedback through our <a href="{{ url('//discordapp.com/invite/nzqRgUw') }}" target="_blank">Discord server</a>.
    </p>
    <small class="text-muted">
        <ul class="list-unstyled">
            <li>ServerLister includes GeoLite2 data created by MaxMind, available from <a href="{{ url('//www.maxmind.com') }}" target="_blank">maxmind.com</a>.</li>
            <li>ServerLister is not affiliated, associated, endorsed by, or in any way connected to Microsoft Corporation or any of its subsidaries or its affiliates.</li>
        </ul>
    </small>
</div>
@endsection
