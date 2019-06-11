@extends('layouts.app')
@section('header')
<meta name="description" content="{{ $server->description }}">
<meta name="og:description" content="{{ $server->description }}">
<meta name="og:image" content="{{ $server->pings->last()->favicon }}">
@endsection
@section('title', $server->name)
@section('content')
<style>
#server-show-hero-wrapper {
    background: url('{{ @$server->pings->where('status', true)->last()->favicon }}') center center;
    background-color: rgb(173, 181, 189);

}
</style>
{{-- Hero --}}
<div id="server-show-hero-wrapper">
    <div class="container-fluid mt-n4 mb-4" id="server-show-hero">
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
            @isset($server->link_website)
                <a href="{{ $server->link_website }}" target="_blank" class="badge badge-light">Website</a>
            @endisset
        </div>
    </div>
</div>

{{-- Content --}}
@component('partials.alert')
@endcomponent
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="row mb-2 align-items-center">
                {{-- About Section --}}
                <div class="col-auto mr-auto">
                    <h3 class="mb-0">{{ __('About') }}</h3>
                </div>
                <div class="col-auto">
                    <a class="btn btn-primary btn-sm" href="{{ route('servers.votes.create', $server->id) }}" role="button"><i class="fal fa-vote-yea fa-fw"></i> Vote</a>
                    @can('update', $server)
                        <a class="btn btn-secondary btn-sm" href="{{ route('servers.show.panel', $server->id) }}" role="button"><i class="fal fa-chart-line fa-fw"></i> Panel</a>
                        <a class="btn btn-secondary btn-sm" href="{{ route('servers.edit', $server->id) }}" role="button"><i class="fal fa-edit fa-fw"></i> Edit</a>
                    @endcan
                </div>
            </div>
            @isset($server->description)
                <div class="overflow-hidden" id="description">
                    {!! $parsedown->text($server->description) !!}
                </div>
            @else
                <p><span class="text-muted">{{ __('No description set.') }}</span></p>
            @endisset
        </div>
        <div class="col-md-4">
            {{-- Information Section --}}
            <h3>{{ __('Information') }}</h3>
            <dl class="row">
                <dt class="col-sm-3">Game</dt>
                <dd class="col-sm-9">Minecraft: Java Edition</dd>
                <dt class="col-sm-3">Version</dt>
                <dd class="col-sm-9"><a href="{{ url('/servers/versions/' . $server->version->slug) }}">{{ $server->version->name }}</a></dd>
                <dt class="col-sm-3">Type</dt>
                <dd class="col-sm-9"><a href="{{ url('/servers/types/' . $server->type->slug) }}">{{ $server->type->name }}</a></dd>
                <dt class="col-sm-3">Country</dt>
                <dd class="col-sm-9"><a href="{{ url('/servers/countries/' . $server->country->slug) }}">{{ $server->country->name }}</a></dd>
            </dl>
            <hr>
            <dl class="row">
                <dt class="col-sm-3">Creator</dt>
                <dd class="col-sm-9">{{ $server->user->username }}</dd>
            </dl>

            {{-- Votes Section --}}
            @if ($server->votes->count() > 0)
                <h3>{{ __('Players') }} <small class="text-muted">Voters</small></h3>
                @foreach ($server->votes->sortByDesc('id')->pluck('username')->countBy()->keys() as $key => $val)
                    @if ($val != null)
                        <img src="{{ url('https://minotar.net/avatar/' . $val. '/24') }}" class="img-fluid rounded" data-toggle="tooltip" data-placement="top" title="{{ $val }}">
                    @endif
                @endforeach
            @endif

        </div>
    </div>
</div>

{{--     <h3>{{ __('Statistics') }}</h3>
    <div class="row">
        <div class="col-md-12">
            <h4 class="text-muted">{{ __('Players') }}</h4>
            <canvas id="canvas-player-history" height="128px"></canvas>
        </div>
        <div class="col-md-6">
            <h4 class="text-muted">{{ __('Votes') }}</h4>
            <canvas id="canvas-vote-history"></canvas>
        </div>
    </div> --}}

<h3></h3>

{{-- Infomation Bar --}}
<div class="container">
    <small class="text-muted" data-toggle="tooltip" data-placement="top" title="{{ __('Server Status') }}">
        <i class="fas {{ $server->pings->last()->status == 1 ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} fa-fw"></i> {{ Carbon\Carbon::parse($server->pings->last()->created_at)->diffForHumans() }}
    </small>
</div>
@endsection
@section('scripts')
{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script> --}}
<script>
$('#description img').addClass('img-fluid');
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
{{-- Needs optimisation --}}
// Chart.defaults.global.defaultFontFamily = 'Nunito';
// var ctx = document.getElementById('canvas-player-history').getContext('2d');
// var playerDataLabels = {!! $playerDataLabels !!};
// var playerData = {!! $playerData !!};
// var myChart = new Chart(ctx, {
//     type: 'line',
//     data: {
//         labels: playerDataLabels,
//         datasets: [{
//             label: 'Max Players',
//             data: playerData
//         }]
//     },
//     options: {
//         scales: {
//             yAxes: [{
//                 ticks: {
//                     beginAtZero: true
//                 }
//             }]
//         }
//     }
// });
</script>
@endsection
