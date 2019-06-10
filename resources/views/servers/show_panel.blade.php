@extends('layouts.app')
@section('title', $server->name . ' - ' . __('Panel'))
@section('content')
<div class="container">
    <div class="row mb-3 align-items-center">
        <div class="col-auto mr-auto">
            <a class="text-decoration-none" href="{{ route('servers.show', $server->id) }}"><i class="fal fa-chevron-left fa-fw"></i> {{ $server->name }}</a>
            <h1 class="font-weight-bold">{{ __('Server Panel') }}</h1>
        </div>
        <div class="col-auto">
            @can('update', $server)
                <a class="btn btn-secondary btn-sm" href="{{ route('servers.edit', $server->id) }}" role="button"><i class="fal fa-edit fa-fw"></i> Edit</a>
            @endcan
        </div>
    </div>
    <div class="card" style="min-height:32rem;">
        <h5 class="card-header">{{ __('Votes') }}</h5>
        @if ($server->votes->count() > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="table-active">
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
            <div class="card-body text-muted">
                No votes.
            </div>
        @endif
    </div>
</div>
@endsection
