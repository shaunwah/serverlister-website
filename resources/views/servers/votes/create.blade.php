@extends('layouts.app')
@section('meta_description', __('Vote for :server_name, a :server_version :server_type-based Minecraft server (:server_ip_address) located in :server_country.', ['server_name' => $server->name, 'server_version' => $server->version->name, 'server_type' => $server->type->name, 'server_country' => $server->country->name, 'server_ip_address' => $server->host . ($server->port != 25565 ? ':' . $server->port : '')]))
@section('meta_robots', 'noindex')
@section('head')
{{-- ReCaptcha --}}
<script src="https://www.google.com/recaptcha/api.js?render={{ env('GOOGLE_RECAPTCHA_SITE') }}"></script>
@endsection
@section('title', $server->name . ' - ' . __('Vote'))
@section('content')
@component('partials.alert')
@endcomponent
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a class="text-decoration-none" href="{{ route('servers.show', $server->id) }}"><i class="fal fa-chevron-left fa-fw"></i> {{ $server->name }}</a>
            <h1 class="font-weight-bold">{{ __('Vote Server') }}</h1>
            <form method="post" action="{{ route('servers.votes.store', $server->id) }}">
                @csrf
                @recaptcha
                @endrecaptcha
                <div class="card">
                    <div class="card-body">

                        {{-- Username Input --}}
                        <div class="form-group">
                            <label for="username">{{ __('Username') }}</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" aria-describedby="usernameHelp" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <small id="usernameHelp" class="form-text text-muted">{{ __('Your Minecraft username is cAsE-sEnSiTiVe.') }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success btn-block">{{ __('Vote for :server_name', ['server_name' => $server->name]) }}</button>
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
        grecaptcha.execute('{{ env('GOOGLE_RECAPTCHA_SITE') }}', {action: 'create_server_vote'}).then(function (response) {
            if (response) {
                document.getElementsByName('g-recaptcha-response')[0].value = response;
            }
        });
    });
</script>
@endsection
