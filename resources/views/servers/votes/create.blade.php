@extends('layouts.app')
@section('meta_description', __('Vote for :server_name, a :server_version :server_type-based Minecraft server (:server_ip_address) located in :server_country.', [
    'server_name' => $server->name,
    'server_version' => $server->version->name,
    'server_type' => $server->type->name,
    'server_country' => $server->country->name,
    'server_ip_address' => $server->host . ($server->port != 25565 ? ':' . $server->port : ''),
]))
@section('head')
<script src="https://www.google.com/recaptcha/api.js?render={{ config('services.google_recaptcha.key') }}"></script>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
@endsection
@section('title', __('text.server_votes.headers.create_alt', ['server_name' => $server->name]))
@section('content')
@component('partials.components.alert')
@endcomponent
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a class="text-decoration-none" href="{{ route('servers.show', $server->id) }}"><i class="fal fa-chevron-left fa-fw"></i> {{ $server->name }}</a>
            <h1 class="font-weight-bold">{{ __('text.server_votes.headers.create') }}</h1>
            <form method="post" action="{{ route('servers.votes.store', $server->id) }}">
                @csrf
                @recaptcha
                @endrecaptcha
                <div class="card mb-3">
                    <div class="card-body">
                        @if ($server->voting_service_enabled)
                            <p>
                                {{ __('text.server_votes.content.receive_rewards') }}
                            </p>
                        @endif

                        {{-- Username Input --}}
                        <div class="form-group">
                            <label for="username">{{ __('attributes.server_votes.username') }}</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" aria-describedby="usernameHelp" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <small id="usernameHelp" class="form-text text-muted">{{ __('forms.server_votes.help.username') }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success btn-block">{{ __('forms.server_votes.buttons.create', ['server_name' => $server->name]) }}</button>
                    </div>
                </div>
            </form>
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-8259485254455968"
                 data-ad-slot="9254587691"
                 data-ad-format="auto"
                 data-full-width-responsive="true"></ins>
            <script>
                 (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('{{ config('services.google_recaptcha.key') }}', {action: 'create_server_vote'}).then(function (response) {
            if (response) {
                document.getElementsByName('g-recaptcha-response')[0].value = response;
            }
        });
    });
</script>
@endsection
