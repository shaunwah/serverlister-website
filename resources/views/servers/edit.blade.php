@extends('layouts.app')
@section('meta_robots', 'noindex, nofollow')
@section('title', __('text.servers.headers.edit'))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a class="text-decoration-none" href="{{ route('servers.update', $server->id) }}"><i class="fal fa-chevron-left fa-fw"></i> {{ $server->name }}</a>
            <h1 class="font-weight-bold">{{ __('text.servers.headers.edit') }}</h1>
            <form method="post" action="{{ route('servers.update', $server->id) }}">
                @method('patch')
                @include('partials.servers_form', ['submitButtonColour' => 'primary', 'submitButtonText' => __('forms.servers.buttons.edit')])
            </form>
            {{-- <a class="text-danger" href="#" onClick="event.preventDefault(); document.getElementById('delete-form').submit();">{{ __('Delete Server') }}</a> --}}
            <form id="delete-form" method="post" action="{{ route('servers.destroy', $server->id) }}">
                @method('delete')
                @csrf
            </form>
        </div>
    </div>
</div>
@endsection
