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
{{-- Title --}}
<div id="hero-wrapper">
    <div class="container-fluid mt-n4 mb-4" id="hero">
        <div class="container py-5 text-white">
            <div class="row align-items-center">
                <div class="col-auto mr-auto">
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
                                <span class="text-muted">/</span>
                                {{ number_format($server->pings->last()->players_total) }}
                            </li>
                        @endif
                        <li class="list-inline-item"><span class="font-weight-bold">{{ __('Votes') }}</span>&nbsp;
                            {{ number_format($voteCountThisMonth) }}
                        </li>
                    </ul>
                </div>
                <div class="col-auto">
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Information --}}
@component('partials.alert')
@endcomponent
<div class="container">
    <div class="row alight-items-center">
        <div class="col-auto mr-auto">
            <h3>{{ __('Information') }}</h3>
            <p>
                @isset($server->description)
                    {{ $server->description }}
                @else
                    <span class="text-muted">{{ __('No description set.') }}</span>
                @endisset
            </p>
        </div>
        <div class="col-auto">
            <a class="btn btn-primary btn-sm" href="{{ route('servers.votes.create', $server->id) }}" role="button"><i class="fal fa-check fa-fw"></i> Vote</a>
            @can('update', $server)
                <a class="btn btn-secondary btn-sm" href="{{ route('servers.show.panel', $server->id) }}" role="button"><i class="fal fa-chart-line fa-fw"></i> Panel</a>
                <a class="btn btn-secondary btn-sm" href="{{ route('servers.edit', $server->id) }}" role="button"><i class="fal fa-edit fa-fw"></i> Edit</a>
            @endcan
        </div>
    </div>
    <h3>{{ __('Player Count') }}</h3>
    <canvas id="canvas-player-history"></canvas>
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
