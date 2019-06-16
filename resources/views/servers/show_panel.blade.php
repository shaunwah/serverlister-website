@extends('layouts.app')
@section('meta_robots', 'noindex, nofollow')
@section('title', $server->name)
@section('content')
@component('partials.components.alert')
@endcomponent
<div class="container">
    <a class="text-decoration-none" href="{{ route('servers.update', $server->id) }}"><i class="fal fa-chevron-left fa-fw"></i> {{ $server->name }}</a>
    <div class="row mb-2 align-items-center">
        <div class="col-auto mr-auto">
            <h1 class="mb-0 font-weight-bold">{{ __('Server Panel') }}</h1>
        </div>
        <div class="col-auto">
            @can('update', $server)
                <a class="btn btn-secondary btn-sm" href="{{ route('servers.edit', $server->id) }}" role="button"><i class="fal fa-edit fa-fw"></i> {{ __('Edit') }}</a>
            @endcan
        </div>
    </div>
    <h4 class="text-muted">{{ __('Votes') }}</h4>
    @if ($server->votes->count() > 0)
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr style="background-color:#dee2e6;">
                        <th scope="col">{{ __('#') }}</th>
                        <th scope="col">{{ __('Username') }}</th>
                        <th scope="col">{{ __('IP Address') }}</th>
                        <th scope="col">{{ __('Voted at') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($server->votes->sortByDesc('created_at')->all() as $vote)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $vote->username }}</td>
                            <td class="text-monospace">{{ $vote->ip_address }}</td>
                            <td>{{ Carbon\Carbon::parse($vote->created_at)->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-muted">
            No votes.
        </div>
    @endif
</div>
@endsection
