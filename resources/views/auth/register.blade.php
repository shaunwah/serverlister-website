@extends('layouts.app')
@section('title', __('Register'))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="font-weight-bold">{{ __('User Registration') }}</h1>
            <form method="post" action="{{ route('register') }}">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="username" class="col-sm-2 col-form-label">{{ __('Username') }}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('Username') }}" minlength="3" maxlength="24" required autocomplete="username" autofocus>
                                @error('Username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" minlength="3" maxlength="255" required autocomplete="email" autofocus>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">{{ __('Password') }}</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" minlength="5" required autocomplete="new-password" >
                                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password_confirmation" class="col-sm-2 col-form-label">{{ __('Confirm') }}</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" minlength="5" required autocomplete="new-password" >
                                @error('password_confirmation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="form-group mb-0 align-items-center">
                            <button type="submit" class="btn btn-success btn-block"><i class="fal fa-user fa-fw"></i> Register</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
