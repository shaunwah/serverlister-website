@extends('layouts.app')
@section('meta_robots', 'noindex, nofollow')
@section('title', __('text.user.headers.console'))
@section('content')
<div class="mt-n4 mb-3 bg-secondary text-white">
    <div class="container py-4">
        <h1 class="font-weight-bold">
            Dashboard <sup><span class="badge badge-pill badge-light">alpha</span></sup>
        </h1>
        <h3>Welcome to the Console, {{ auth()->user()->username }}.</h3>
    </div>
</div>
@component('partials.alert')
@endcomponent

{{-- Statistics Section --}}
<div class="container mb-3">
    <h2 class="font-weight-bold">{{ __('text.headers.statistics') }}</h2>
    <div class="card-deck">
        <div class="card">
            <div class="card-body">
                <span class="fa-stack fa-2x align-middle">
                    <i class="fas fa-circle fa-stack-2x text-dark"></i>
                    <i class="fal fa-users fa-stack-1x fa-inverse"></i>
                </span>
                <h3 class="card-title d-inline-block mb-0 align-middle">{{ number_format($users->count()) }}<small class="d-block text-muted">{{ __('text.headers.users') }}</small></h3>
            </div>
        </div>
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
                    <i class="fal fa-flag-alt fa-stack-1x fa-inverse"></i>
                </span>
                <h3 class="card-title d-inline-block mb-0 align-middle">{{ number_format($reports->count()) }}<small class="d-block text-muted">{{ __('text.headers.reports') }}</small></h3>
            </div>
        </div>
    </div>
</div>

{{-- Reports Section --}}
<div class="container">
    <h2 class="font-weight-bold">{{ __('text.headers.reports') }}</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Issue</th>
                <th scope="col">Reporter</th>
                <th scope="col">Updated</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports->sortByDesc('updated_at') as $report)
                <tr>
                    <th scope="row">{{ $report->id }}</th>
                    <td><a href="{{ route('console.reports.show', $report->id) }}">{{ $report->issue }}</a></td>
                    <td>{{ $report->user->username }}</td>
                    <td>{{ $report->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
