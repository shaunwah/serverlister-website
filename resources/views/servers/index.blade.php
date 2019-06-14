@extends('layouts.app')
@section('meta_description', isset($filters) ? __('A list of the best Minecraft servers related to :filtered_name.', ['filtered_name' => $filtered->name]) : __('Displaying all Minecraft servers on ServerLister.'))
@section('title', isset($filters) ? $filtered->name . ' - ' .  __('Servers') : __('Servers'))
@section('content')
@component('partials.alert')
@endcomponent
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @isset($filters)
                <a class="text-decoration-none" href="{{ route('servers.index') }}"><i class="fal fa-chevron-left fa-fw"></i> Servers</a>
            @endisset
            <div class="row mb-2 align-items-center">
                <div class="col-auto mr-auto">
                    <h1 class="mb-0 font-weight-bold">{{ __('Servers') }} @isset($filters)<small class="text-muted">{{ __('in') . ' ' . $filtered->name }}</small>@endisset</h1>
                </div>
                <div class="col-auto">
                    <div class="dropdown d-inline-block">
                        <a class="btn btn-secondary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ __('Filter by') }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="{{ url('/servers/versions/1_14_2') }}">{{ __('Version') }}</a>
                            <a class="dropdown-item" href="{{ url('/servers/types/survival') }}">{{ __('Type') }}</a>
                            <a class="dropdown-item" href="{{ url('/servers/countries/united-states') }}">{{ __('Country') }}</a>
                        </div>
                    </div>
{{--                     @auth --}}
                        <a class="btn btn-success btn-sm" href="{{ route('servers.create') }}" role="button"><i class="fal fa-plus fa-fw"></i> {{ __('Create') }}</a>
{{--                     @endauth --}}
                </div>
            </div>

            @isset($filters)
                <div class="form-group mt-3 mt-sm-0">
                    <select class="form-control" id="filterSelect">
                        @foreach ($filters as $filter)
                            <option {{ $filtered->id == $filter->id ? 'selected' : '' }} value="{{ $filter->slug }}">{{ $filter->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endisset

            @if ($servers->count() > 0)
                @foreach ($servers as $server)
                    @component('partials.card_server', ['loop' => $loop, 'server' => $server])
                    @endcomponent
                @endforeach
                {{ $servers->links() }}
            @else
                <div class="card bg-transparent border shadow-none">
                    <div class="card-body text-muted text-center" id="card-no-data">
                        <h5 class="card-title font-weight-bold mb-0 ">Empty :(</h5>
                        No servers. Create one?
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
@section('scripts')
@isset($filters)
    <script>
        $('#filterSelect').change(function () {
            var selected = $('#filterSelect').children('option:selected').val();
            location.replace(selected);
        });
    </script>
@endisset
@endsection
