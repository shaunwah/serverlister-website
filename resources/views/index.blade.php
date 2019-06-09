@extends('layouts.app')
@section('header')
<meta name="description" content="ServerLister helps you to find the best Minecraft servers out there.">
<meta name="og:description" content="ServerLister helps you to find the best Minecraft servers out there.">
@endsection
@section('title', __('Welcome'))
@section('content')
<div class="container">
    <div class="jumbotron mb-3">
        <h1 class="display-4">Hey there.</h1>
        <p class="lead">ServerLister helps you to find the best Minecraft servers out there.</p>
        <a class="btn btn-primary btn-lg" href="{{ route('servers.index') }}" role="button">Let's Go <i class="fal fa-arrow-right fa-fw"></i></a>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <div class="card mb-3 mb-md-0">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto mr-auto">
                            <span class="text-muted">{{ __('Servers') }}</span>
                            <h4 class="text-monospace">{{ number_format(App\Server::count()) }}</h4>
                        </div>
                        <div class="col-auto">
                            <i class="fal fa-server fa-fw fa-2x text-muted"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3 mb-md-0">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto mr-auto">
                            <span class="text-muted">{{ __('Server Pings') }}</span>
                            <h4 class="text-monospace">{{ number_format(App\ServerPing::count()) }}</h4>
                        </div>
                        <div class="col-auto">
                            <i class="fal fa-users fa-fw fa-2x text-muted"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3 mb-md-0">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto mr-auto">
                            <span class="text-muted">{{ __('Votes') }}</span>
                            <h4 class="text-monospace">{{ number_format(App\ServerVote::count()) }}</h4>
                        </div>
                        <div class="col-auto">
                            <i class="fal fa-check fa-fw fa-2x text-muted"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h2 class="font-weight-bold">Popular Servers</h2>
    @foreach (App\Server::orderBy('rank', 'asc')->paginate(3) as $server)
        <div class="card {{ !$loop->last ? 'mb-3' : '' }} {{ $server->pings->last()->status == 1 ? 'shift-server-card-online' : 'shift-server-card-offline' }}">
            <div class="card-body px-3 py-1">
                <div class="row no-gutters align-items-center">
                    <div class="d-none d-sm-block col-sm-1 text-left">
                        <i class="fal fa-hashtag fa-fw"></i> {{ number_format($server->rank, 0, '.', ',') }}
                    </div>
                    <div class="col-3 col-sm-2 col-md-1 text-left text-md-center">
                        <img src="{{ $server->pings->last()->favicon }}" class="rounded" alt="Favicon" height="48px" width="48px">
                    </div>
                    <div class="col-6 col-sm-7 col-md-8 text-left text-truncate">
                        <a class="font-weight-bold" href="{{ route('servers.show', $server->id) }}">{{ $server->name }}</a>
                        <span class="text-muted">{{ $server->version->name }}</span>
                        <span class="d-block text-truncate">{{ $server->host }}{{ $server->port != 25565 ? ':' . $server->port : '' }}</span>
                    </div>
                    <div class="col-3 col-sm-2 text-right">
                        @if ($server->pings->last()->status == 1)
                        {{ number_format($server->pings->last()->players_current, 0, '.', ',') }} <i class="fal fa-users fa-fw"></i>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
