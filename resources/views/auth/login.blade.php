@extends('layouts.app')
@section('meta_robots', 'nofollow')
@section('title', __('text.user.headers.login'))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="post" action="{{ route('login') }}">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title font-weight-bold">{{ __('text.user.headers.login') }}</h1>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">{{ __('attributes.users.email') }}</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" minlength="3" maxlength="24" required autocomplete="email" autofocus>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">{{ __('attributes.users.password') }}</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="current-password">
                                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10 offset-sm-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                    <label class="form-check-label" for="remember">
                                    {{ __('attributes.users.remember_me') }}
                                </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-0 align-items-center">
                            @if (Route::has('password.request'))
                            <div class="col-auto mr-auto">
                                <a href="{{ route('password.request') }}">{{ __('text.user.content.forgot_password') }}</a>
                            </div>
                            @endif
                            <div class="col-auto ml-auto">
                                <button type="submit" class="btn btn-primary"><i class="fal fa-sign-in fa-fw"></i> {{ __('forms.user.buttons.login') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
