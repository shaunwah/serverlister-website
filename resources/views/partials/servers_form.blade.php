@csrf
<input type="hidden" name="id" value="{{ $server->id }}"></input>
<div class="card mb-3">
    <div class="card-body">

        {{-- Name Input --}}
        <div class="form-group">
            <label for="name">{{ __('attributes.servers.name') }}</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $server->name) }}" minlength="3" maxlength="24" placeholder="My Minecraft Server" required autofocus>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        {{-- Description Input --}}
        <div class="form-group">
            <label for="description">{{ __('attributes.servers.description') }} <small class="text-muted">{{ __('forms.labels.optional') }}</small></label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="9">{{ old('description', $server->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @else
                <small id="descriptionHelp" class="form-text text-muted">{!! __('forms.servers.help.description') !!}</small>
            @enderror
        </div>

        {{-- Host & Port Input --}}
        <div class="form-row">
            <div class="form-group col-md-9">
                <label for="host">{{ __('attributes.servers.host') }}</label>
                <input type="text" class="form-control @error('host') is-invalid @enderror" id="host" name="host" value="{{ old('host', $server->host) }}" minlength="3" maxlength="24" placeholder="play.server.xyz" required>
                @error('host')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-3">
                <label for="port">{{ __('attributes.servers.port') }}</label>
                <input type="text" class="form-control @error('port') is-invalid @enderror" id="port" name="port" value="{{ old('port', isset($server->port) ? $server->port : 25565) }}" placeholder="25565" required>
                @error('port')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <hr>

        {{-- Country Input --}}
        <div class="form-group">
            <label for="country">{{ __('attributes.servers.country') }}</label>
            <select class="form-control @error('country_id') is-invalid @enderror" id="country" name="country_id" required>
                <option disabled selected value="">{{ __('forms.servers.options.country') }}</option>
                @foreach ($countries as $country)
                    <option {{ old('country_id', $server->country_id) == $country->id ? 'selected' : '' }} value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
            @error('country_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        {{-- Version & Type Input --}}
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="version">{{ __('attributes.servers.version') }}</label>
                <select class="form-control @error('version_id') is-invalid @enderror" id="version" name="version_id" required>
                    <option disabled selected value="">{{ __('forms.servers.options.version') }}</option>
                    @foreach ($versions as $version)
                        <option {{ old('version_id', $server->version_id) == $version->id ? 'selected' : '' }} value="{{ $version->id }}">{{ $version->name }}</option>
                    @endforeach
                </select>
                @error('version_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-6">
                <label for="type">{{ __('attributes.servers.type') }}</label>
                <select class="form-control @error('type_id') is-invalid @enderror" id="type" name="type_id" required>
                    <option disabled selected value="">{{ __('forms.servers.options.type') }}</option>
                    @foreach ($types as $type)
                        <option {{ old('type_id', $server->type_id) == $type->id ? 'selected' : '' }} value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
                @error('type_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
        <hr>

        {{-- Website Link Input --}}
        <div class="form-group">
            <label for="link_website">{{ __('attributes.servers.link_website') }} <small class="text-muted">{{ __('forms.labels.optional') }}</small></label>
            <input type="url" class="form-control @error('link_website') is-invalid @enderror" id="link_website" name="link_website" value="{{ old('link_website', $server->link_website) }}" placeholder="https://www.minecraft.net/">
            @error('link_website')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ __('text.servers.headers.voting_service') }}</h5>
        <p>{!! __('text.servers.content.voting_service_information') !!}</p>

        {{-- Voting Service Enabled Input --}}
        <div class="custom-control custom-switch mb-3">
            <input type="checkbox" class="custom-control-input" id="voting_service_enabled" name="voting_service_enabled" {{ $server->voting_service_enabled ? 'checked' : '' }}>
            <label class="custom-control-label" for="voting_service_enabled">{{ __('attributes.servers.voting_service_enabled') }}</label>
        </div>

        {{-- Voting Service Host & Port Input --}}
        <div class="form-row">
            <div class="form-group col-md-9">
                <label for="voting_service_host">{{ __('attributes.servers.host') }} <small class="text-muted">{{ __('forms.labels.optional') }}</small></label>
                <input type="text" class="form-control @error('voting_service_host') is-invalid @enderror" id="voting_service_host" name="voting_service_host" value="{{ old('voting_service_host', $server->voting_service_host) }}" minlength="3" maxlength="24">
                @error('voting_service_host')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group col-md-3">
                <label for="voting_service_port">{{ __('attributes.servers.port') }} <small class="text-muted">{{ __('forms.labels.optional') }}</small></label>
                <input type="text" class="form-control @error('voting_service_port') is-invalid @enderror" id="voting_service_port" name="voting_service_port" value="{{ old('voting_service_port', isset($server->voting_service_port) ? $server->voting_service_port : 8192) }}" placeholder="8192">
                @error('voting_service_port')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        {{-- Voting Service Token Input --}}
        <div class="form-group">
            <label for="voting_service_token">{{ __('attributes.servers.voting_service_token') }} <small class="text-muted">{{ __('forms.labels.optional') }}</small></label>
            <input type="text" class="form-control @error('voting_service_token') is-invalid @enderror" id="voting_service_token" aria-describedby="voting_service_tokenHelp" name="voting_service_token" value="{{ old('voting_service_token', isset($server->voting_service_token) ? decrypt($server->voting_service_token) : '') }}">
            @error('voting_service_token')
                <div class="invalid-feedback">{{ $message }}</div>
            @else
                <small id="voting_service_tokenHelp" class="form-text text-muted">{{ __('forms.servers.help.voting_service_token') }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-{{ $submitButtonColour }} btn-block">{{ $submitButtonText }}</button>
    </div>
</div>
