@extends('layouts.app')
@section('meta_robots', 'noindex, nofollow')
@section('title', $report->issue)
@section('content')
<div class="container">
    <h1 class="font-weight-bold">
        {{ __('text.reports.headers.view') }}
    </h1>
    <div class="row">
        <div class="col-md-8">
            <h3>{{ __('attributes.reports.issue') }}</h3>
            <p>
                {{ $report->issue }}
            </p>

            <h3>{{ __('attributes.reports.description') }}</h3>
            <p>
                {{ $report->description }}
            </p>
        </div>
        <div class="col-md-4">
            <h3>{{ __('text.headers.information') }}</h3>
            <dl class="row">
                <dt class="col-sm-3">{{ __('Entity') }}</dt>
                <dd class="col-sm-9"><a href="{{ route('servers.show', $entity->id) }}">{{ $entity->name }}</a></dd>
                <dt class="col-sm-3">{{ __('Status') }}</dt>
                <dd class="col-sm-9">{{ $report->status }}</dd>
            </dl>
            <hr>
            <dl class="row">
                <dt class="col-sm-3">Creator</dt>
                <dd class="col-sm-9">{{ $report->user->username }}</dd>
                <dt class="col-sm-3">Assignee</dt>
                <dd class="col-sm-9">NIL</dd>
                <dt class="col-sm-3">{{ __('Created') }}</dt>
                <dd class="col-sm-9">{{ $report->created_at }}</dd>
                <dt class="col-sm-3">{{ __('Updated') }}</dt>
                <dd class="col-sm-9">{{ $report->updated_at }}</dd>
            </dl>
        </div>
    </div>
</div>
@endsection
