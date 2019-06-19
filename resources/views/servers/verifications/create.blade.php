@extends('layouts.app')
@section('meta_robots', 'noindex, nofollow')
@section('head')
{{-- ReCaptcha --}}
<script src="https://www.google.com/recaptcha/api.js?render={{ config('services.google_recaptcha.key') }}"></script>
@endsection
@section('title', __('text.server_verifications.headers.create'))
@section('content')
@component('partials.components.alert')
@endcomponent
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a class="text-decoration-none" href="{{ route('servers.show', $server->id) }}"><i class="fal fa-chevron-left fa-fw"></i> {{ $server->name }}</a>
            <h1 class="font-weight-bold">{{ __('text.server_verifications.headers.create') }}</h1>
            <div class="card mb-3">
                <div class="card-body">
                    <p>
                        To begin the verification process, please follow these steps:
                    </p>
                    <h5 class="card-title">Step 1</h5>
                    <p>
                        Access your server's file system and open 'server.properties' and replace the MOTD with the following verification phrase:
                    </p>
                    <div class="form-group">
                        <input type="text" class="form-control" id="verification_phrase" name="verification_phrase" value="{{ $verificationPhrase }}" readonly>
                    </div>
                    <h5 class="card-title">Step 2</h5>
                    <p>
                        Click on the 'Verify Server' button to verify your server.
                    </p>
                    <h5 class="card-title">Step 3</h5>
                    <p>
                        Once your server has been marked as verified, you may remove the verification phrase.
                    </p>
                    <form method="post" action="{{ route('servers.verifications.store', $server->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-block">{{ __('forms.server_verifications.buttons.create') }}</button>
                    </form>
                </div>
            </div>
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
