@extends('layouts.app')
@section('header')
<meta name="robots" content="noindex, nofollow">
@endsection
@section('title', __('Account'))
@section('content')
<div class="container">
    <a class="text-decoration-none" href="{{ route('index') }}"><i class="fal fa-chevron-left fa-fw"></i> {{ __('Home') }}</a>
    <h1 class="font-weight-bold">{{ __('Settings') }}</h1>
    <div class="row">
        <div class="col-md-3 mb-3 mb-md-0">
            <div class="card">
                <ul class="list-group list-group-flush">
                    <a href="/user/settings/account" class="list-group-item list-group-item-action active"><i class="fal fa-user fa-fw"></i> Account</a>
                    <a href="/user/settings/security" class="list-group-item list-group-item-action"><i class="fal fa-lock fa-fw"></i> Security</a>
{{--                     <a href="#" class="list-group-item list-group-item-action disabled"><i class="fal fa-receipt fa-fw"></i> Billing</a>
                    <a href="#" class="list-group-item list-group-item-action disabled"><i class="fal fa-envelope fa-fw"></i> Notifications</a> --}}
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <form method="post" action="{{ url('user/settings') }}">
                @method('patch')
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Account') }}</h5>
                        <div class="form-group row">
                            <label for="username" class="col-sm-2 col-form-label">{{ __('Username') }}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $user->username) }}" required autofocus>
                                @error('username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="timezone" class="col-sm-2 col-form-label">{{ __('Timezone') }}</label>
                            <div class="col-sm-10">
                                <select class="form-control @error('timezone') is-invalid @enderror" id="timezone" name="timezone" disabled>
                                    <option value="UTC">(GMT) UTC</option>
                                </select>
                                @error('timezone')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
