@extends('layouts.app')
@section('meta_robots', 'noindex, nofollow')
@section('head')
{{-- ReCaptcha --}}
<script src="https://www.google.com/recaptcha/api.js?render={{ config('services.google_recaptcha.key') }}"></script>
@endsection
@section('title', __('text.reports.headers.create'))
@section('content')
@component('partials.components.alert')
@endcomponent
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a class="text-decoration-none" href="{{ route('servers.show', $server->id) }}"><i class="fal fa-chevron-left fa-fw"></i> {{ $server->name }}</a>
            <h1 class="font-weight-bold">{{ __('text.reports.headers.create') }}</h1>
            <form method="post" action="{{ route('servers.reports.store', $server->id) }}">
                @csrf
                @recaptcha
                @endrecaptcha
                <div class="card mb-3">
                    <div class="card-body">
                        <p>
                            {{ __('text.reports.content.information', ['entity_name' => $server->name]) }}
                        </p>
                        <p>
                            {{ __('text.reports.content.server_disclaimer') }}
                        </p>
                        <p class="text-muted">
                            To verify and take ownership of a server, visit the <a href="{{ route('servers.verifications.create', $server->id) }}">Server Verification page</a>.
                        </p>

                        {{-- Issue Input --}}
                        <div class="form-group">
                            <label for="issue">{{ __('attributes.reports.issue') }}</label>
                            <input type="text" class="form-control @error('issue') is-invalid @enderror" id="issue" name="issue" value="{{ old('issue') }}" minlength="3" required autofocus>
                            @error('issue')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Description Input --}}
                        <div class="form-group">
                            <label for="description">{{ __('attributes.reports.description') }}</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" aria-describedby="descriptionHelp" name="description" rows="9" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <small id="descriptionHelp" class="form-text text-muted">{{ __('forms.reports.help.description') }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">{{ __('forms.reports.buttons.create') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('{{ config('services.google_recaptcha.key') }}', {action: 'create_report'}).then(function (response) {
            if (response) {
                document.getElementsByName('g-recaptcha-response')[0].value = response;
            }
        });
    });
</script>
@endsection
