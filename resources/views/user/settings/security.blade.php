@extends('layouts.app')
@section('header')
<meta name="robots" content="noindex, nofollow">
@endsection
@section('title', __('Security'))
@section('content')
<div class="container">
    <a class="text-decoration-none" href="{{ route('index') }}"><i class="fal fa-chevron-left fa-fw"></i> {{ __('Home') }}</a>
    <h1 class="font-weight-bold">{{ __('Settings') }}</h1>
    <div class="row">
        <div class="col-md-3 mb-3 mb-md-0">
            <div class="card">
                <ul class="list-group list-group-flush">
                    <a href="/user/settings/account" class="list-group-item list-group-item-action"><i class="fal fa-user fa-fw"></i> Account</a>
                    <a href="/user/settings/security" class="list-group-item list-group-item-action active"><i class="fal fa-lock fa-fw"></i> Security</a>
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
                        <h5 class="card-title">{{ __('Security') }}</h5>
                        <p class="card-text">
                            You should change your password on a regular basis as a security measure.
                            ServerLister staff will never ask for your password.
                        </p>
                        <div class="form-group row">
                            <label for="current_password" class="col-sm-2 col-form-label">{{ __('Current') }}</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="password" name="current_password" minlength="5" required autocomplete="password">
                                @error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">{{ __('New') }}</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" minlength="5" required autocomplete="new-password">
                                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password_confirmation" class="col-sm-2 col-form-label">{{ __('Confirm') }}</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" minlength="5" required autocomplete="new-password">
                                @error('password_confirmation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-auto ml-auto">
                                <button type="submit" class="btn btn-primary"><i class="fal fa-edit fa-fw"></i> Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
