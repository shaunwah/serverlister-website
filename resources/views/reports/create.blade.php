@extends('layouts.app')
@section('header')
<meta name="robots" content="noindex, nofollow">
@endsection
@section('title', __('Create - Reports'))
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a class="text-decoration-none" href="{{ route(Illuminate\Support\Str::plural(request()->entity) . '.show', request()->entity_id) }}"><i class="fal fa-chevron-left fa-fw"></i> {{ request()->entity_name }}</a>
            <h1 class="font-weight-bold">{{ __('Report ' . ucwords(request()->entity)) }}</h1>
            <form method="post" action="{{ route('reports.store') }}">
                @csrf
                <input type="hidden" name="entity" value="{{ request()->entity }}"></input>
                <input type="hidden" name="entity_id" value="{{ request()->entity_id }}"></input>
                <input type="hidden" name="type_id" value="1"></input> {{-- !!! --}}
                <div class="card mb-3">
                    <div class="card-body">
                        <p>
                            You are reporting <span class="font-weight-bold">{{ request()->entity_name }}</span> for abuse of ServerLister's Terms of Service.
                        </p>
                        @if (request()->entity == 'server')
                            <p>
                                ServerLister and its staff cannot resolve issues regarding internal server matters.
                                In such cases, you are advised to communicate directly with the server staff to resolve your
                                issues.

                                <span class="text-muted">
                                    Automated server takeover/verification will be available soon.
                                </span>
                            </p>
                        @endif

                        {{-- Issue Input --}}
                        <div class="form-group">
                            <label for="issue">Issue <small class="text-muted">required</small></label>
                            <input type="text" class="form-control @error('issue') is-invalid @enderror" id="issue" name="issue" value="{{ old('issue') }}" minlength="3" required autofocus>
                            @error('issue')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- Description Input --}}
                        <div class="form-group">
                            <label for="description">Description <small class="text-muted">required</small></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" aria-describedby="descriptionHelp" name="description" rows="9" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <small id="descriptionHelp" class="form-text text-muted">Describing the issue in detail helps us resolve the issue as fast as possible.</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Send Report</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
