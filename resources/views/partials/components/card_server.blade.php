{{-- Server Card (requires loop and $server) --}}
<div class="card shift-server-card pop {{ (!$loop->last ? 'mb-3' : '') }} {{ (@$server->pings->last()->status == true ? 'online' : 'offline') }} {{ (isset($theme) ? 'bg-dark text-white shadow-none' : '' ) }}" id="server-{{ $server->id }}">
    <div class="card-body px-3 py-1">
        <div class="row no-gutters align-items-center">
            <div class="d-none d-sm-block col-sm-1 text-left">
                <i class="fal fa-hashtag fa-fw"></i> {{ number_format($server->rank) }}
            </div>
            <div class="col-3 col-sm-2 col-md-1 text-left text-md-center">
                <img src="{{ asset($server->favicon) }}" class="rounded" alt="Favicon" height="48px" width="48px">
            </div>
            <div class="col-6 col-sm-7 col-md-8 text-left text-truncate">
                <span class="flag-icon {{ 'flag-icon-' . strtolower($server->country->code) }}"></span>
                <a class="font-weight-bold text-decoration-none text-reset" href="{{ route('servers.show', $server->id) }}">{{ $server->name }}</a>
                <span class="d-none d-sm-inline {{ isset($theme) ? 'text-white-50' : 'text-muted' }}">{{ $server->version->name }}</span>
                <span class="d-block">{{ $server->host . ($server->port != 25565 ? ':' . $server->port : '') }}</span>
            </div>
            <div class="col-3 col-sm-2 text-right">
                @if (@$server->pings->last()->status == 1)
                    {{ number_format(@$server->pings->last()->players_current) }} <i class="fal fa-users fa-fw"></i>
                @endif
            </div>
        </div>
    </div>
</div>
