{{-- Alert --}}
@if (session('alert'))
    <div class="container" id="alert">
        <div class="alert alert-{{ session('alert_colour', 'info') }} alert-dismissible show" role="alert">
            <i class="fal fa-info-circle fa-fw"></i> {{ session('alert') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif
