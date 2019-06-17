@extends('layouts.app')
@section('meta_robots', 'noindex, nofollow')
@section('title', __('text.user.headers.dashboard'))
@section('content')
<div class="mt-n4 mb-3 bg-secondary text-white">
    <div class="container py-4">
        <h1 class="font-weight-bold">
            {{ __('text.user.headers.dashboard') }}
        </h1>
        <h3>{{ __('text.user.content.welcome', ['username' => auth()->user()->username]) }}</h3>
    </div>
</div>
@component('partials.components.alert')
@endcomponent

{{-- Statistics Section --}}
<div class="container mb-3">
    <h2 class="font-weight-bold">{{ __('text.user.headers.statistics') }}</h2>
    <div class="card-deck">
        <div class="card">
            <div class="card-body">
                <span class="fa-stack fa-2x align-middle">
                    <i class="fas fa-circle fa-stack-2x text-dark"></i>
                    <i class="fal fa-server fa-stack-1x fa-inverse"></i>
                </span>
                <h3 class="card-title d-inline-block mb-0 align-middle">{{ number_format(App\Server::where('user_id', auth()->id())->count()) }}<small class="d-block text-muted">{{ __('text.headers.servers') }}</small></h3>
            </div>
        </div>
    </div>
</div>

{{-- Servers Section --}}
<div class="container">
    <div class="row mb-2 align-items-center">
        <div class="col-auto mr-auto">
            <h2 class="mb-0 font-weight-bold">{{ __('text.user.headers.servers') }}</h2>
        </div>
        <div class="col-auto">
            <a class="btn btn-success btn-sm" href="{{ route('servers.create') }}" role="button"><i class="fal fa-plus fa-fw"></i> {{ __('text.buttons.create') }}</a>
        </div>
    </div>
    @if ($servers->count() > 0)
        @foreach ($servers as $server)
            @component('partials.components.card_server', ['loop' => $loop, 'server' => $server])
            @endcomponent
        @endforeach
        {{ $servers->links() }}
    @else
        <div class="card bg-transparent border shadow-none">
            <div class="card-body text-muted text-center" id="card-no-data">
                <h5 class="card-title font-weight-bold mb-0 ">Empty :(</h5>
                {{ __('text.servers.content.empty_server')}}
            </div>
        </div>
    @endif
</div>
@endsection
