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
                        {{-- Username Input --}}
                        <div class="form-group">
                            <label for="username">Username <small class="text-muted">optional</small></label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" aria-describedby="usernameHelp" name="username" value="{{ old('username') }}" autocomplete="username" autofocus>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <small id="usernameHelp" class="form-text text-muted">{{ __('Your Minecraft username is cAsE-sEnSiTiVe.') }}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success btn-block"><i class="fal fa-vote-yea fa-fw"></i> Vote for {{ $server->name }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
