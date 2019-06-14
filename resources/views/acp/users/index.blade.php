@extends('layouts.app')
@section('meta_robots', 'noindex, nofollow')
@section('title', '!!!')
@section('content')
<div class="container">
    <h1 class="font-weight-bold">
        {{ __('Admin Control Panel') }}
    </h1>
    <style>
        .card > .table
        {
            margin-bottom: 0;
        }
    </style>
    <div class="card">
        <h5 class="card-header">{{ __('Users') }}</h5>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach (App\User::all() as $user)
                <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td></td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
</div>
@endsection
