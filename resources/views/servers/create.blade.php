@extends('layouts.app')
@section('meta_robots', 'noindex')
@section('head')
{{-- ReCaptcha --}}
<script src="https://www.google.com/recaptcha/api.js?render={{ config('services.google_recaptcha.key') }}"></script>
@endsection
@section('title', __('text.servers.headers.create'))
@section('content')
@component('partials.components.alert')
@endcomponent
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a class="text-decoration-none" href="{{ route('servers.index') }}"><i class="fal fa-chevron-left fa-fw"></i> {{ __('text.headers.servers') }}</a>
            <h1 class="font-weight-bold">{{ __('text.servers.headers.create') }}</h1>
            <form method="post" action="{{ route('servers.store') }}">
                @include('partials.servers_form', ['server' => new App\Server, 'submitButtonColour' => 'success', 'submitButtonText' => __('forms.servers.buttons.create')])
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('{{ config('services.google_recaptcha.key') }}', {action: 'create_server'}).then(function (response) {
            if (response) {
                document.getElementsByName('g-recaptcha-response')[0].value = response;
            }
        });
    });
</script>
@endsection
