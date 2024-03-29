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
                    <a href="/user/settings/account" class="list-group-item list-group-item-action"><i class="fal fa-user fa-fw"></i> {{ __('text.user.headers.account') }}</a>
                    <a href="/user/settings/security" class="list-group-item list-group-item-action active"><i class="fal fa-lock fa-fw"></i> {{ __('text.user.headers.security') }}</a>
{{--                     <a href="#" class="list-group-item list-group-item-action disabled"><i class="fal fa-receipt fa-fw"></i> Billing</a>
                    <a href="#" class="list-group-item list-group-item-action disabled"><i class="fal fa-envelope fa-fw"></i> Notifications</a> --}}
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <form method="post" action="{{ url('user/settings/security') }}">
                @method('patch')
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('text.user.headers.security') }}</h5>
                        <div class="form-group row">
                            <label for="current_password" class="col-sm-2 col-form-label">{{ __('attributes.users.password_current') }}</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="password" name="current_password" minlength="5" required autocomplete="password">
                                @error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">{{ __('attributes.users.password_new') }}</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" minlength="5" required autocomplete="new-password">
                                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password_confirmation" class="col-sm-2 col-form-label">{{ __('attributes.users.password_confirmation') }}</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" minlength="5" required autocomplete="new-password">
                                @error('password_confirmation')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
