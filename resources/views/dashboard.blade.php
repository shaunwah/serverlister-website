@extends('layouts.app')
@section('meta_robots', 'noindex, nofollow')
@section('title', __('Dashboard'))
@section('content')
<div class="mt-n4 mb-3 bg-secondary text-white">
    <div class="container py-4">
        <h1 class="font-weight-bold">
            Dashboard <sup><span class="badge badge-pill badge-light">beta</span></sup>
        </h1>
        <h3>Welcome back, {{ auth()->user()->username }}.</h3>
    </div>
</div>
@component('partials.alert')
@endcomponent

{{-- Statistics Section --}}
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

{{-- Reports Section --}}
@if (auth()->id() == 1)
    <div class="container">
        <h2 class="font-weight-bold">Your Reports</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">{{ __('#') }}</th>
                    <th scope="col">{{ __('Issue') }}</th>
                    <th scope="col">{{ __('Reporter') }}</th>
                    <th scope="col">{{ __('Updated') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports->sortByDesc('updated_at') as $report)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $report->issue }}</td>
                    <td>{{ $report->user->username }}</td>
                    <td>{{ $report->updated_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

{{-- Servers Section --}}
<div class="container">
    <div class="row mb-2 align-items-center">
        <div class="col-auto mr-auto">
            <h2 class="mb-0 font-weight-bold">{{ __('Your Servers') }}</h2>
        </div>
        <div class="col-auto">
            <a class="btn btn-success btn-sm" href="{{ route('servers.create') }}" role="button"><i class="fal fa-plus fa-fw"></i> {{ __('Create') }}</a>
        </div>
    </div>
    @if ($servers->count() > 0)
        @foreach ($servers as $server)
            @component('partials.card_server', ['loop' => $loop, 'server' => $server])
            @endcomponent
        @endforeach
        {{ $servers->links() }}
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
