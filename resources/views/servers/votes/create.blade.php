@extends('layouts.app')
@section('header')
<meta name="robots" content="noindex">
@endsection
@section('title', $server->name . ' - ' . __('Vote'))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a class="text-decoration-none" href="{{ route('servers.show', $server->id) }}"><i class="fal fa-chevron-left fa-fw"></i> {{ $server->name }}</a>
            <h1 class="font-weight-bold">{{ __('Vote Server') }}</h1>
            <form method="post" action="{{ route('servers.votes.store', $server->id) }}">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Vote for {{ $server->name }}</h5>
                        <div class="form-group row">
                            <label for="username" class="col-sm-2 col-form-label">{{ __('Username') }}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $server->username) }}" minlength="3" maxlength="16" required autocomplete="username" autofocus>
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <small id="usernameHelp" class="form-text text-muted">{{ __('Your Minecraft username is cAsE-sEnSiTiVe.') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0 align-items-center">
                            <div class="col-auto mr-auto">
                                <small class="text-muted">{{ $server->voting_service_enabled ? 'You may receive a reward for voting.' : '' }}</small>
                            </div>
                            <div class="col-auto ml-auto">
                                <button type="submit" class="btn btn-success"><i class="fal fa-check fa-fw"></i> Vote</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
