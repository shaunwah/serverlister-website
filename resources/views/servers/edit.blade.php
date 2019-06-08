@extends('layouts.app')
@section('header')
<meta name="robots" content="noindex, nofollow">
@endsection
@section('title', $server->name . ' - ' . __('Edit'))
@section('content')
<div class="container">
    <a class="text-decoration-none" href="{{ route('servers.show', $server->id) }}"><i class="fal fa-chevron-left fa-fw"></i> {{ $server->name }}</a>
    <h1 class="font-weight-bold">{{ __('Edit Server') }}</h1>
    <form method="post" action="{{ route('servers.update', $server->id) }}">
        @method('patch')
        @csrf
        <input type="hidden" name="id" value="{{ $server->id }}"></input>
        <div class="card mb-3">
            <div class="card-body">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $server->name) }}" minlength="3" maxlength="24" required autofocus>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-sm-2 col-form-label">{{ __('Description') }} <small class="text-muted">{{ __('optional') }}</small></label>
                    <div class="col-sm-10">
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="7" name="description">{{ old('description', $server->description) }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="ip_address" class="col-sm-2 col-form-label">{{ __('IP Address') }}</label>
                    <div class="col-sm-10">
                        <div class="form-row">
                            <div class="col-9">
                                <input type="text" class="form-control @error('host') is-invalid @enderror" id="host" name="host" placeholder="Host" value="{{ old('host', $server->host) }}" minlength="3" maxlength="24" required>
                                @error('host')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-3">
                                <input type="text" class="form-control @error('port') is-invalid @enderror" id="port" name="port" placeholder="Port" value="25565" value="{{ old('port', $server->port) }}" required>
                                @error('port')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <h5 class="card-title">{{ __('Features') }}</h5>
                <div class="form-group row">
                    <label for="type_and_version" class="col-sm-2 col-form-label">{{ __('Version & Type') }}</label>
                    <div class="col-sm-10">
                        <div class="form-row">
                            <div class="col-6">
                                <select class="form-control @error('version') is-invalid @enderror" id="version" name="version_id" required>
                                    <option disabled selected value="">{{ __('select a version') }}</option>
                                    @foreach ($versions as $version)
                                        <option {{ old('version_id', $server->version_id) == $version->id ? 'selected' : '' }} value="{{ $version->id }}">{{ $version->name }}</option>
                                    @endforeach
                                </select>
                                @error('version_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-6">
                                <select class="form-control @error('type') is-invalid @enderror" id="type" name="type_id" required>
                                    <option disabled selected value="">{{ __('select a type') }}</option>
                                    @foreach ($types as $type)
                                        <option {{ old('type_id', $server->type_id) == $type->id ? 'selected' : '' }} value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                                @error('type_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="country" class="col-sm-2 col-form-label">{{ __('Country') }}</label>
                    <div class="col-sm-10">
                        <select class="form-control @error('country') is-invalid @enderror" id="country" name="country_id" required>
                            <option disabled selected value="">{{ __('select a country') }}</option>
                            @foreach ($countries as $country)
                                <option {{ old('country_id', $server->country_id) == $country->id ? 'selected' : '' }} value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                        @error('country_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <hr>
                <h5 class="card-title">{{ __('Votifier') }}</h5>
                <div class="form-group row">
                    <label for="voting_service_ip_address" class="col-sm-2 col-form-label">{{ __('IP Address') }} <small class="text-muted">{{ __('optional') }}</small></label>
                    <div class="col-sm-10">
                        <div class="form-row">
                            <div class="col-9">
                                <input type="text" class="form-control @error('voting_service_host') is-invalid @enderror" id="voting_service_host" name="voting_service_host" placeholder="Host" value="{{ old('voting_service_host', $server->voting_service_host) }}" minlength="3" maxlength="24">
                                @error('voting_service_host')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-3">
                                <input type="text" class="form-control @error('voting_service_port') is-invalid @enderror" id="voting_service_port" name="voting_service_port" placeholder="Port" value="{{ old('voting_service_port', $server->voting_service_port) }}">
                                @error('voting_service_port')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="voting_service_token" class="col-sm-2 col-form-label">{{ __('Token') }} <small class="text-muted">{{ __('optional') }}</small></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('voting_service_token') is-invalid @enderror" id="voting_service_token" name="voting_service_token" value="{{ old('voting_service_token', decrypt($server->voting_service_token)) }}">
                        @error('voting_service_token')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="voting_service_enabled" name="voting_service_enabled" {{ $server->voting_service_enabled ? 'checked' : '' }}>
                            <label class="form-check-label" for="voting_service_enabled">
                            {{ __('Enable Votifier') }}
                        </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-auto mr-auto">
                        <a class="text-danger" href="#" onClick="event.preventDefault(); document.getElementById('delete-form').submit();">{{ __('Delete Server') }}</a>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary"><i class="fal fa-edit fa-fw"></i> Edit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <form id="delete-form" method="post" action="{{ route('servers.destroy', $server->id) }}">
        @method('delete')
        @csrf
    </form>
</div>
@endsection
