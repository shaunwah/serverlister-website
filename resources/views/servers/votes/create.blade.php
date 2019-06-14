@extends('layouts.app')
@section('meta_description', __('Vote for :server_name, a :server_version :server_type-based Minecraft server located in :server_country.', ['server_name' => $server->name, 'server_version' => $server->version->name, 'server_type' => $server->type->name, 'server_country' => $server->country->name]))
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
            @if ($server->votes->count() > 0)
                <div class="mt-3">
                    @foreach ($server->votes->sortByDesc('id')->pluck('username')->countBy()->keys() as $key => $val)
                        @if ($val != null)
                            <img src="{{ url('https://minotar.net/avatar/' . $val. '/24') }}" class="img-fluid rounded" data-toggle="tooltip" data-placement="top" title="{{ $val }}">
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endsection
