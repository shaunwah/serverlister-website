<?php

namespace App\Listeners;

use App\ServerPing;
use App\Events\ServerCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PingServer
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ServerCreated  $event
     * @return void
     */
    public function handle(ServerCreated $event)
    {
        $ping = new ServerPing;
        $ping->pingServer($event->server);
    }
}
