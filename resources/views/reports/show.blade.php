@extends('layouts.app')
@section('meta_robots', 'noindex, nofollow')
@section('title', $report->issue)
@section('content')
<div class="container">
    <h1 class="font-weight-bold">
        {{ __('Report') }}
    </h1>
    <div class="row">
        <div class="col-md-8">
            <h3>{{ __('Issue') }}</h3>
            <p>
                {{ $report->issue }}
            </p>

            <h3>{{ __('Description') }}</h3>
            <p>
                {{ $report->description }}
            </p>
        </div>
        <div class="col-md-4">
            <h3>{{ __('Information') }}</h3>
            <dl class="row">
                <dt class="col-sm-3">{{ __('Entity') }}</dt>
                <dd class="col-sm-9"><a href="{{ route('servers.show', $entity->id) }}">{{ $entity->name }}</a></dd>
            </dl>
            <hr>
            <dl class="row">
                <dt class="col-sm-3">{{ __('Created') }}</dt>
                <dd class="col-sm-9">{{ $report->created_at }}</dd>
                <dt class="col-sm-3">{{ __('Updated') }}</dt>
                <dd class="col-sm-9">{{ $report->updated_at }}</dd>
            </dl>
            <hr>
            <dl class="row">
                <dt class="col-sm-3">Creator</dt>
                <dd class="col-sm-9">{{ $report->user->username }}</dd>
            </dl>
        </div>
    </div>
</div>
@endsection
