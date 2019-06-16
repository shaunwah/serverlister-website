@extends('layouts.app')
@section('header')
<meta name="robots" content="noindex, nofollow">
@endsection
@section('title', __('text.user.headers.settings'))
@section('content')
@component('partials.components.alert')
@endcomponent
<div class="container">
    <h1 class="font-weight-bold">{{ __('text.user.headers.settings') }}</h1>
    <div class="row">
        <div class="col-md-3 mb-3 mb-md-0">
            <div class="card">
                <ul class="list-group list-group-flush">
                    <a href="/user/settings/account" class="list-group-item list-group-item-action active"><i class="fal fa-user fa-fw"></i> {{ __('text.user.headers.account') }}</a>
                    <a href="/user/settings/security" class="list-group-item list-group-item-action"><i class="fal fa-lock fa-fw"></i> {{ __('text.user.headers.security') }}</a>
{{--                     <a href="#" class="list-group-item list-group-item-action disabled"><i class="fal fa-receipt fa-fw"></i> Billing</a>
                    <a href="#" class="list-group-item list-group-item-action disabled"><i class="fal fa-envelope fa-fw"></i> Notifications</a> --}}
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <form method="post" action="{{ url('user/settings/account') }}">
                @method('patch')
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('text.user.headers.account') }}</h5>
                        <div class="form-group row">
                            <label for="username" class="col-sm-2 col-form-label">{{ __('attributes.users.username') }}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $user->username) }}" required autofocus>
                                @error('username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">{{ __('attributes.users.email') }}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="timezone" class="col-sm-2 col-form-label">{{ __('attributes.users.timezone') }}</label>
                            <div class="col-sm-10">
                                <select class="form-control @error('timezone') is-invalid @enderror" id="timezone" name="timezone" disabled>
                                    <option value="UTC">(GMT) UTC</option>
                                </select>
                                @error('timezone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">{{ __('forms.user.buttons.edit') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
