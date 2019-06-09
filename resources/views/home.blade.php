@extends('layouts.app')
@section('title', __('Home'))
@section('content')
<div class="container">
    <h1 class="font-weight-bold">
        Home
    </h1>
    <h3>Welcome back, {{ auth()->user()->username }}.</h3>
    <div class="row">
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
@endsection
