@extends('layouts.app')
@section('meta_description', __(':server_name is a v:server_version :server_type-based Minecraft server located in :server_country. Join other players in :server_name via :server_ip_address.', ['server_name' => $server->name, 'server_version' => $server->version->name, 'server_type' => $server->type->name, 'server_country' => $server->country->name, 'server_ip_address' => $server->host . ($server->port != 25565 ? ':' . $server->port : '')]))
@section('head')
<meta name="og:image" content="{{ asset($server->favicon) }}">
@endsection
@section('title', $server->name)
@section('content')
<style>
#server-show-hero-wrapper {
    background: url('{{ asset($server->favicon) }}') center center;
    background-color: hsl(0, 0%, 25%);
}
</style>
{{-- Hero --}}
<div id="server-show-hero-wrapper">
    <div class="mt-n4 mb-4" id="server-show-hero">
        <div class="container py-5 text-white">
            <h1 class="font-weight-bold">
                {{ $server->name }}
                <small class="d-block text-white-50">{{ $server->host . ($server->port != 25565 ? ':' . $server->port : '') }}</small>
            </h1>
            <ul class="list-inline">
                <li class="list-inline-item"><span class="font-weight-bold">{{ __('attributes.servers.rank') }}</span>&nbsp;
                    {{ number_format($server->rank) }}
                </li>
                @if (@$server->pings->last()->status)
                    <li class="list-inline-item">
                        <span class="font-weight-bold">{{ __('attributes.server_pings.players') }}</span>&nbsp;
                        {{ number_format(@$server->pings->last()->players_current) }}
                        <span class="text-white-50">/</span>
                        {{ number_format(@$server->pings->last()->players_total) }}
                    </li>
                @endif
                <li class="list-inline-item"><span class="font-weight-bold">{{ __('attributes.servers.votes') }}</span>&nbsp;
                    {{ number_format(App\ServerVote::where('server_id', $server->id)->whereMonth('created_at', today()->format('m'))->count()) }}
                </li>
            </ul>
            @isset($server->link_website)
                <a href="{{ $server->link_website }}" target="_blank" class="badge badge-pill badge-light">{{ __('attributes.servers.link_website') }}</a>
            @endisset
        </div>
    </div>
</div>

{{-- Content --}}
@component('partials.components.alert')
@endcomponent
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="row mb-2 align-items-center">
                {{-- About Section --}}
                <div class="col-auto mr-auto">
                    <h3 class="mb-0">{{ __('text.headers.about') }}</h3>
                </div>
                <div class="col-auto">
                    <a class="btn btn-primary btn-sm" href="{{ route('servers.votes.create', $server->id) }}" role="button"><i class="fal fa-vote-yea fa-fw"></i> {{ __('text.buttons.vote') }}</a>
                    <a class="btn btn-warning btn-sm" href="{{ route('servers.reports.create', $server->id) }}" role="button"><i class="fal fa-exclamation-triangle fa-fw"></i> {{ __('text.buttons.report') }}</a>
                    @can('update', $server)
{{--                         <a class="btn btn-secondary btn-sm" href="{{ route('servers.show.panel', $server->id) }}" role="button"><i class="fal fa-chart-line fa-fw"></i> Panel</a> --}}
                        <a class="btn btn-secondary btn-sm" href="{{ route('servers.edit', $server->id) }}" role="button"><i class="fal fa-edit fa-fw"></i> {{ __('text.buttons.edit') }}</a>
                    @endcan
                </div>
            </div>
            @empty(!$server->description)
                <div class="overflow-hidden" id="description">
                    {!! $parsedown->text($server->description) !!}
                </div>
            @else
                <p><span class="text-muted">{{ __('text.servers.content.empty_description') }}</span></p>
            @endempty
        </div>
        <div class="col-md-4 order-1 order-md-0">
            {{-- Information Section --}}
            <h3>{{ __('text.headers.information') }}</h3>
            <dl class="row">
                <dt class="col-sm-3">{{ __('attributes.servers.game') }}</dt>
                <dd class="col-sm-9">{{ __('attributes.servers.games.minecraft_java') }}</dd>
                <dt class="col-sm-3">{{ __('attributes.servers.version') }}</dt>
                <dd class="col-sm-9"><a href="{{ url('/servers/versions/' . $server->version->slug) }}">{{ $server->version->name }}</a></dd>
                <dt class="col-sm-3">{{ __('attributes.servers.type') }}</dt>
                <dd class="col-sm-9"><a href="{{ url('/servers/types/' . $server->type->slug) }}">{{ $server->type->name }}</a></dd>
                <dt class="col-sm-3">{{ __('attributes.servers.country') }}</dt>
                <dd class="col-sm-9"><a href="{{ url('/servers/countries/' . $server->country->slug) }}">{{ $server->country->name }}</a></dd>
            </dl>
            <hr>
            <dl class="row">
            @if ($server->user_id != 1)
                <dt class="col-sm-3">{{ __('attributes.servers.created_by') }}</dt>
                <dd class="col-sm-9">{{ $server->user->username }}</dd>
            @endif
                <dt class="col-sm-3">{{ __('attributes.servers.created_at') }}</dt>
                <dd class="col-sm-9">{{ Carbon\Carbon::parse($server->created_at)->locale(app()->getLocale())->isoFormat('ll') }}</dd>
            </dl>
        </div>
        <div class="col-md-8 order-0 order-md-1">
            {{-- Statistics Section --}}
            <h3>{{ __('text.headers.statistics') }}</h3>
            <h3 class="text-muted">{{ __('attributes.server_pings.players') }}</h3>
            <canvas id="player-stats"></canvas>
            <h3 class="text-muted">{{ __('attributes.servers.votes') }}</h3>
            <canvas id="vote-stats"></canvas>
        </div>
    </div>
</div>

{{-- Infomation Bar --}}
<div class="container">
    <small class="text-muted" data-toggle="tooltip" data-placement="top" title="{{ __('text.servers.content.last_pinged_at') }}">
        <i class="fas {{ @$server->pings->last()->status == 1 ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} fa-fw"></i> {{ Carbon\Carbon::parse(@$server->pings->last()->created_at)->locale(app()->getLocale())->diffForHumans() }}
    </small>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
<script>
$('#description img').addClass('img-fluid');
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
Chart.defaults.global.defaultFontFamily = ['Nunito', 'Noto Sans TC'];
var playerStatsCtx = document.getElementById('player-stats').getContext('2d');
var voteStatsCtx = document.getElementById('vote-stats').getContext('2d');
var dateLabels = {!! json_encode($data['dates']) !!};
var playersDataMax = {!! json_encode($data['players']['playersMaxData']) !!};
var playersDataAvg = {!! json_encode($data['players']['playersAvgData']) !!};
var votesData = {!! json_encode($data['votes']) !!};
var myChart = new Chart(playerStatsCtx, {
    type: 'line',
    data: {
        labels: dateLabels,
        datasets: [{
            label: ['{{ __('text.servers.headers.statistics.max_players') }}'],
            data: playersDataMax,
            backgroundColor: 'rgba(40,167,69,0.25)',
            borderColor: "rgba(40,167,69,0.5)"
        }, {
            label: ['{{ __('text.servers.headers.statistics.average_players') }}'],
            data: playersDataAvg,
            backgroundColor: 'rgba(0,123,255,0.25)',
            borderColor: "rgba(0,123,255,0.5)"
        }]
    },
    options: {
        tooltips: {
            mode: 'index',
            intersect: false
        }
    }
});
var myChart = new Chart(voteStatsCtx, {
    type: 'line',
    data: {
        labels: dateLabels,
        datasets: [{
            label: ['{{ __('text.servers.headers.statistics.total_votes') }}'],
            data: votesData,
            backgroundColor: 'rgba(40,167,69,0.25)',
            borderColor: "rgba(40,167,69,0.5)"
        }]
    },
    options: {
        tooltips: {
            mode: 'index',
            intersect: false
        }
    }
});
</script>
@endsection
