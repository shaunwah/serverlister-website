@extends('layouts.app')
@section('meta_description', 'ServerLister is a Minecraft server list that helps you find the best Minecraft servers in the wild.')
@section('title', __('text.headers.home'))
@section('content')
{{-- Hero --}}
<div id="intro-hero-wrapper">
    <div class="container-fluid mt-n4 mb-3" id="intro-hero">
        <div class="container px-0 px-sm-3 py-4">
            <div class="row align-items-center mb-3 mb-md-0">
                <div class="col-auto mr-auto">
                    <h1 class="font-weight-bold text-white">ServerLister</h1>
                    <p class="lead text-white">
                        {{ __('text.home.content.call_to_action') }}
                    </p>
                </div>
                <div class="col-auto">
                    <a class="btn btn-outline-light btn-lg" href="{{ route('servers.index') }}" role="button">{{ __('text.home.content.call_to_action_button') }} <i class="fal fa-arrow-right fa-fw"></i></a>
                </div>
            </div>

            {{-- Top Servers --}}
            <div>
                <h2 class="text-white">{{ __('text.servers.headers.top') }}</h2>
                @foreach ($servers->sortBy('rank')->take(3) as $server)
                    @component('partials.card_server', ['theme' => 'dark', 'loop' => $loop, 'server' => $server])
                    @endcomponent
                @endforeach
            </div>

            {{-- New Servers --}}
            <div class="mb-3">
                <h2 class="mt-3 text-white">{{ __('text.servers.headers.new') }}</h2>
                @foreach ($servers->sortByDesc('created_at')->take(3) as $server)
                    @component('partials.card_server', ['theme' => 'dark', 'loop' => $loop, 'server' => $server])
                    @endcomponent
                @endforeach
            </div>

            <small class="text-white-50">
                {{ __('text.home.content.last_pinged_at', ['time_difference' => Carbon\Carbon::parse($servers->sortBy('rank')->first()->pings->last()->created_at)->locale(app()->getLocale())->diffForHumans()]) }}
            </small>
        </div>
    </div>
</div>

{{-- Statistics Section --}}
<div class="container mb-3">
    <h2 class="font-weight-bold">{{ __('text.headers.statistics') }}</h2>
    <div class="card-deck">
        <div class="card">
            <div class="card-body">
                <span class="fa-stack fa-2x align-middle">
                    <i class="fas fa-circle fa-stack-2x text-dark"></i>
                    <i class="fal fa-server fa-stack-1x fa-inverse"></i>
                </span>
                <h3 class="card-title d-inline-block mb-0 align-middle">{{ number_format($servers->count()) }}<small class="d-block text-muted">{{ __('text.headers.servers') }}</small></h3>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <span class="fa-stack fa-2x align-middle">
                    <i class="fas fa-circle fa-stack-2x text-dark"></i>
                    <i class="fal fa-users fa-stack-1x fa-inverse"></i>
                </span>
                <h3 class="card-title d-inline-block mb-0 align-middle">{{ number_format(App\ServerPing::pluck('players_current', 'server_id')->sum()) }}<small class="d-block text-muted">{{ __('attributes.server_pings.players') }}</small></h3>
            </div>
        </div>
    </div>
</div>

{{-- Features Section --}}
{{-- <div class="container mb-3">
    <h2 class="font-weight-bold">Features</h2>
    <div class="card-deck">
        <div class="card">
            <div class="card-body">
                <span class="fa-stack fa-2x">
                    <i class="fas fa-circle fa-stack-2x text-dark"></i>
                    <i class="fal fa-chart-line fa-stack-1x fa-inverse"></i>
                </span>
                <h3 class="font-weight-bold">Server Console</h3>
                <p class="lead mb-0">
                    Select and view multiple server datasets<sup>1</sup>, including player trend
                    and vote tracking.
                </p>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <span class="fa-stack fa-2x">
                    <i class="fas fa-circle fa-stack-2x text-dark"></i>
                    <i class="fal fa-arrow-down fa-stack-1x fa-inverse"></i>
                </span>
                <h3 class="font-weight-bold">Downtime Alerts</h3>
                <p class="lead mb-0">
                    Get updates via email<sup>1</sup> if your server goes offline for a
                    period of time.
                </p>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <span class="fa-stack fa-2x">
                    <i class="fas fa-circle fa-stack-2x text-dark"></i>
                    <i class="fal fa-lock fa-stack-1x fa-inverse"></i>
                </span>
                <h3 class="font-weight-bold">Secure</h3>
                <p class="lead mb-0">
                    Your user and server information are encrypted and stored in accordance
                    to the best guidelines.
                </p>
            </div>
        </div>
    </div>
</div> --}}
<div class="container">
    <small class="text-muted">
        <ul class="list-unstyled">
            <li>ServerLister includes GeoLite2 data created by <a href="{{ url('//www.maxmind.com') }}" target="_blank">MaxMind</a>.</li>
            <li>ServerLister is protected by reCAPTCHA and the Google  <a href="https://policies.google.com/privacy" target="_blank">Privacy Policy</a> and <a href="https://policies.google.com/terms" target="_blank">Terms of Service</a> apply.</li>
            <li>ServerLister is not affiliated, associated, endorsed by, or in any way connected to Microsoft Corporation or any of its subsidaries or its affiliates.</li>
        </ul>
    </small>
</div>
@endsection
