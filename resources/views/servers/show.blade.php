@extends('layouts.app')
@section('header')
<meta name="description" content="{{ $server->description }}">
<meta name="og:description" content="{{ $server->description }}">
<meta name="og:image" content="{{ $server->pings->last()->favicon }}">
@endsection
@section('title', $server->name)
@section('content')
<style>
#hero-wrapper {
    background: url('{{ $server->pings->last()->favicon }}') center center;
    background-color: rgb(108, 117, 125);

}

#hero {
    background: rgba(52, 58, 64, 0.9);
}
</style>
{{-- Hero --}}
<div id="hero-wrapper">
    <div class="container-fluid mt-n4 mb-4" id="hero">
        <div class="container px-0 px-sm-3 py-5 text-white">
            <h1 class="font-weight-bold">
                {{ $server->name }}
                <small class="d-block text-white-50">{{ $server->host . ($server->port != 25565 ? ':' . $server->port : '') }}</small>
            </h1>
            <ul class="list-inline">
                <li class="list-inline-item"><span class="font-weight-bold">{{ __('Rank') }}</span>&nbsp;
                    {{ number_format($server->rank) }}
                </li>
                <li class="list-inline-item"><span class="font-weight-bold">{{ __('Score') }}</span>&nbsp;
                    {{ number_format($server->score, 2) }}
                </li>
                @if ($server->pings->last()->status)
                    <li class="list-inline-item">
                        <span class="font-weight-bold">{{ __('Players') }}</span>&nbsp;
                        {{ number_format($server->pings->last()->players_current) }}
                        <span class="text-white-50">/</span>
                        {{ number_format($server->pings->last()->players_total) }}
                    </li>
                @endif
                <li class="list-inline-item"><span class="font-weight-bold">{{ __('Votes') }}</span>&nbsp;
                    {{ number_format($voteCountThisMonth) }}
                </li>
            </ul>
        </div>
    </div>
</div>

{{-- Content --}}
@component('partials.alert')
@endcomponent
<div class="container">
    <div class="row align-items-center">
        <div class="col-auto mr-auto">
            <h3>{{ __('Information') }}</h3>
{{--             <h4 class="text-muted">{{ __('Description') }}</h4> --}}
            <p>
                @isset($server->description)
                    {{ $server->description }}
                @else
                    <span class="text-muted">{{ __('No description set.') }}</span>
                @endisset
            </p>
        </div>
        <div class="col-auto">
            <a class="btn btn-primary btn-sm" href="{{ route('servers.votes.create', $server->id) }}" role="button"><i class="fal fa-vote-yea fa-fw"></i> Vote</a>
            @can('update', $server)
                <a class="btn btn-secondary btn-sm" href="{{ route('servers.show.panel', $server->id) }}" role="button"><i class="fal fa-chart-line fa-fw"></i> Panel</a>
                <a class="btn btn-secondary btn-sm" href="{{ route('servers.edit', $server->id) }}" role="button"><i class="fal fa-edit fa-fw"></i> Edit</a>
            @endcan
        </div>
    </div>
    <h3>{{ __('Statistics') }}</h3>
    <div class="row">
        <div class="col-md-12">
            <h4 class="text-muted">{{ __('Players') }}</h4>
            <canvas id="canvas-player-history" height="128px"></canvas>
        </div>
{{--         <div class="col-md-6">
            <h4 class="text-muted">{{ __('Votes') }}</h4>
            <canvas id="canvas-vote-history"></canvas>
        </div> --}}
    </div>
</div>

{{-- Infomation Bar --}}
<div class="container">
    <div class="row align-items-center">
        <div class="col-auto mr-auto">
            <small class="text-muted" data-toggle="tooltip" data-placement="top" title="{{ __('Server Status') }}">
                <i class="fas {{ $server->pings->last()->status == 1 ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} fa-fw"></i> {{ Carbon\Carbon::parse($server->pings->last()->created_at)->diffForHumans() }}
            </small>
        </div>
        <div class="col-auto">
            <a href="{{ url('/servers/versions/' . $server->version->slug) }}" class="badge badge-pill badge-danger">{{ $server->version->name }}</a>
            <a href="{{ url('/servers/types/' . $server->type->slug) }}" class="badge badge-pill badge-success">{{ $server->type->name }}</a>
            <a href="{{ url('/servers/countries/' . $server->country->slug) }}" class="badge badge-pill badge-primary">{{ $server->country->name }}</a>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
<script>
{{-- Needs optimisation --}}
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
Chart.defaults.global.defaultFontFamily = 'Nunito';
var ctx = document.getElementById('canvas-player-history').getContext('2d');
var playerDataLabels = {!! $playerDataLabels !!};
var playerData = {!! $playerData !!};
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: playerDataLabels,
        datasets: [{
            label: 'Max Players',
            data: playerData
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
@endsection
