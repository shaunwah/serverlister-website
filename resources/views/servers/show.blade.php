@extends('layouts.app')
@section('header')
<meta name="description" content="{{ $server->description }}">
<meta name="og:description" content="{{ $server->description }}">
<meta name="og:image" content="{{ $server->pings->last()->favicon }}">
@endsection
@section('title', $server->name)
@section('content')
<div class="container">
    <div class="row mb-3 align-items-center">
        <div class="col-auto mr-auto">
            <a class="text-decoration-none" href="{{ route('servers.index') }}"><i class="fal fa-chevron-left fa-fw"></i> Servers</a>
        </div>
        <div class="col-auto">
            <a class="btn btn-primary btn-sm" href="{{ route('servers.votes.create', $server->id) }}" role="button"><i class="fal fa-check fa-fw"></i> Vote</a>
            @can('update', $server)
                <a class="btn btn-secondary btn-sm" href="{{ route('servers.show.panel', $server->id) }}" role="button"><i class="fal fa-chart-line fa-fw"></i> Panel</a>
                <a class="btn btn-secondary btn-sm" href="{{ route('servers.edit', $server->id) }}" role="button"><i class="fal fa-edit fa-fw"></i> Edit</a>
            @endcan
        </div>
    </div>
    <div class="card mb-3" style="min-height:32rem;">
        <div class="card-body">
            <h1 class="card-title font-weight-bold">
                {{ $server->name }}
                <small class="text-muted d-block">
                    {{ $server->host }}{{ $server->port != 25565 ? ':' . $server->port : '' }}
                </small>
            </h1>
            <h2 class="d-none d-md-block display-3 text-muted" id="card-rank">
                <sup><i class="fal fa-hashtag fa-xs fa-fw"></i></sup>{{ number_format($server->rank, 0, '.', ',') }}
            </h2>
            <ul class="list-inline mb-1">
                @if ($server->pings->last()->status)
                    <li class="list-inline-item">
                        <span class="font-weight-bold">{{ __('Players') }}</span>&nbsp; {{ number_format($server->pings->last()->players_current, 0, '.', ',') }}
                        <span class="text-muted">/</span>
                        {{ number_format($server->pings->last()->players_total, 0, '.', ',') }}
                    </li>
                @endif
                <li class="list-inline-item"><span class="font-weight-bold">
                    {{ __('Score') }}</span>&nbsp; {{ number_format($server->score, 2, '.', ',') }}
                </li>
                <li class="list-inline-item"><span class="font-weight-bold">
                    {{ __('Votes') }}</span>&nbsp; {{ number_format($voteCountThisMonth, 0, '.', ',') }}
                </li>
            </ul>
            <hr>
            <div class="row">
                <div class="col-md-10 order-1 order-md-0">
                    <div class="tab-content" id="tabContent">
                        {{-- Description Tab --}}
                        <div class="tab-pane show active" id="information" role="tabpanel" aria-labelledby="information-tab">
                            <h5 class="card-subtitle mb-2 text-muted">{{ __('Description') }}</h5>
                            <p class="card-text">
                                @isset($server->description)
                                    {{ $server->description }}
                                @else
                                    <span class="text-muted">{{ __('No description set.') }}</span>
                                @endisset
                            </p>
                        </div>
                        {{-- Comments Tab --}}
{{--                         <div class="tab-pane" id="comments" role="tabpanel" aria-labelledby="comments-tab">
                            @auth
                                <form method="post" action="{{ route('servers.comments.store', $server->id) }}">
                                    @csrf
                                    <div class="form-group">
                                        <textarea class="form-control @error('body') is-invalid @enderror" id="comment_body" name="body" rows="3" style="resize:none;" required></textarea>
                                        @error('body')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block"><i class="fal fa-comment fa-fw"></i> Comment</button>
                                </form>
                            @else
                                <p class="card-text text-muted"><a href="{{ route('login') }}">Login</a> or <a href="{{ route('register') }}">register an account</a> to post a comment.</p>
                            @endauth
                            <hr>
                            @if($server->comments->count() > 0)
                                <ul class="list-unstyled">
                                @foreach ($server->comments->sortByDesc('created_at') as $comment)
                                    <li class="media {{ $loop->last ? '' : 'mb-3' }} align-items-center">
                                        <img src="{{ url('https://www.gravatar.com/avatar/' . md5($comment->owner->email) . '.jpg') }}" class="rounded mr-2" alt="Avatar" height="32px" width="32px">
                                        <div class="media-body">
                                            <span class="font-weight-bold">{{ $comment->owner->username }}</span> {{ $comment->body }}
                                            <small class="text-muted">{{ Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</small>
                                        </div>
                                    </li>
                                @endforeach
                                </ul>
                            @else
                                <p class="card-text text-muted">{{ __('No comments. Make one?') }}</p>
                            @endif
                        </div> --}}
                        {{-- Statistics Tab --}}
                        <div class="tab-pane" id="statistics" role="tabpanel" aria-labelledby="statistics-tab">
                        <h5 class="card-subtitle mb-2 text-muted">{{ __('Player Count') }}</h5>
                        <canvas id="canvas-player-history" height="128px"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 order-0 order-md-1 mb-3 mb-md-0">
                    <div class="nav flex-column nav-pills text-left text-md-right" id="tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="information-tab" data-toggle="pill" href="#information" role="tab" aria-controls="information" aria-selected="true">{{ __('Information') }}
                            <i class="fal fa-question-circle fa-fw"></i>
                        </a>
{{--                         <a class="nav-link" id="comments-tab" data-toggle="pill" href="#comments" role="tab" aria-controls="comments" aria-selected="false">{{ __('Comments') }}
                            <i class="fal fa-comments fa-fw"></i>
                        </a> --}}
                        <a class="nav-link" id="statistics-tab" data-toggle="pill" href="#statistics" role="tab" aria-controls="statistics" aria-selected="false">{{ __('Statistics') }}
                            <i class="fal fa-chart-line fa-fw"></i>
                        </a>
                    </div>
                </div>
            </div>
            <img src="{{ $server->pings->last()->favicon }}" class="rounded" id="card-favicon" alt="{{ __('Favicon') }}">
        </div>
    </div>
    <div class="row">
        <div class="col-auto mr-auto">
            <small class="text-muted" data-toggle="tooltip" data-placement="top" title="{{ __('Server Status') }}"><i class="fas {{ $server->pings->last()->status == 1 ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' }} fa-fw"></i> {{ Carbon\Carbon::parse($server->pings->last()->created_at)->diffForHumans() }}</small>
        </div>
        <div class="col-auto">
            <a href="{{ url('/servers/versions/' . $server->version->slug) }}" class="badge badge-pill badge-danger shadow-sm">{{ $server->version->name }}</a>
            <a href="{{ url('/servers/types/' . $server->type->slug) }}" class="badge badge-pill badge-success shadow-sm">{{ $server->type->name }}</a>
            <a href="{{ url('/servers/countries/' . $server->country->slug) }}" class="badge badge-pill badge-primary shadow-sm">{{ $server->country->name }}</a>
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
            label: 'Average Players',
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
