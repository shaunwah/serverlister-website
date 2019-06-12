@extends('layouts.app')
@section('title', __('Home'))
@section('content')
<div class="container-fluid mt-n4 mb-3 bg-secondary text-white">
    <div class="container px-0 px-sm-3 py-4">
        <h1 class="font-weight-bold">
            Dashboard <sup><span class="badge badge-pill badge-light">beta</span></sup>
        </h1>
        <h3>Welcome back, {{ auth()->user()->username }}.</h3>
    </div>
</div>
<div class="container mb-3">
    <h2 class="font-weight-bold">Your Statistics</h2>
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
    </div>
</div>
<div class="container">
    <h2 class="font-weight-bold">Your Servers</h2>
    @if ($servers->count() > 0)
        @foreach ($servers as $server)
            <div class="card {{ !$loop->last ? 'mb-3' : '' }} {{ @$server->pings->last()->status == 1 ? 'shift-server-card-online' : 'shift-server-card-offline' }}">
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
                            <span class="text-muted">{{ $server->version->name }}</span>
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
    @else
        <div class="card bg-transparent border shadow-none">
            <div class="card-body text-muted text-center" id="card-no-data">
                <h5 class="card-title font-weight-bold mb-0 ">Empty :(</h5>
                No servers. Create one?
            </div>
        </div>
    @endif
</div>
@endsection
