@extends('layouts.app')
@section('header')
<meta name="description" content="noindex, nofollow">
@endsection
@section('title', isset($filters) ? $filtered->name . ' - ' .  __('Servers') : __('Servers'))
@section('content')
@component('partials.alert')
@endcomponent
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @isset($filters)
                <a class="text-decoration-none" href="{{ route('servers.index') }}"><i class="fal fa-chevron-left fa-fw"></i> Servers</a>
            @endisset
            <div class="row align-items-center">
                <div class="col-auto mr-auto">
                    <h1 class="font-weight-bold">{{ __('Servers') }} @isset($filters)<small class="text-muted">{{ __('in') . ' ' . $filtered->name }}</small>@endisset</h1>
                </div>
                <div class="col-auto">
                    <div class="dropdown d-inline-block">
                        <a class="btn btn-secondary btn-sm dropdown-toggle border-0 shadow-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ __('Filter by') }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="{{ url('/servers/versions/1_14_2') }}">{{ __('Version') }}</a>
                            <a class="dropdown-item" href="{{ url('/servers/types/survival') }}">{{ __('Type') }}</a>
                            <a class="dropdown-item" href="{{ url('/servers/countries/united-states') }}">{{ __('Country') }}</a>
                        </div>
                    </div>
                    @auth
                        <a class="btn btn-success btn-sm" href="{{ route('servers.create') }}" role="button"><i class="fal fa-plus fa-fw"></i> {{ __('Create') }}</a>
                    @endauth
                </div>
            </div>

            @isset($filters)
                <div class="form-group mt-3 mt-sm-0">
                    <select class="form-control" id="filterSelect">
                        @foreach ($filters as $filter)
                            <option {{ $filtered->id == $filter->id ? 'selected' : '' }} value="{{ $filter->slug }}">{{ $filter->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endisset

            @if ($servers->count() > 0)
                @foreach ($servers as $server)
                    <div class="card {{ !$loop->last ? 'mb-3' : '' }} {{ $server->pings->last()->status == 1 ? 'shift-server-card-online' : 'shift-server-card-offline' }}">
                        <div class="card-body px-3 py-1">
                            <div class="row no-gutters align-items-center">
                                <div class="d-none d-sm-block col-sm-1 text-left">
                                    <i class="fal fa-hashtag fa-fw"></i> {{ number_format($server->rank) }}
                                </div>
                                <div class="col-3 col-sm-2 col-md-1 text-left text-md-center">
                                    <img src="{{ @$server->pings->where('status', true)->last()->favicon }}" class="rounded" alt="Favicon" height="48px" width="48px">
                                </div>
                                <div class="col-6 col-sm-7 col-md-8 text-left text-truncate">
                                    <a class="font-weight-bold" href="{{ route('servers.show', $server->id) }}">{{ $server->name }}</a> <span class="text-muted">{{ $server->version->name }}</span>
                                    <span class="d-block">{{ $server->host . ($server->port != 25565 ? ':' . $server->port : '') }}</span>
                                </div>
                                <div class="col-3 col-sm-2 text-right">
                                    @if ($server->pings->last()->status == 1)
                                        {{ number_format($server->pings->last()->players_current) }} <i class="fal fa-users fa-fw"></i>
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
    </div>
</div>
@endsection
@section('scripts')
@isset($filters)
    <script>
        $('#filterSelect').change(function () {
            var selected = $('#filterSelect').children('option:selected').val();
            location.replace(selected);
        });
    </script>
@endisset
@endsection
