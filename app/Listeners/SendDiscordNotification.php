<?php

namespace App\Listeners;

use App\Server;
use App\Events\ServerVoteCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendDiscordNotification
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
     * @param  ServerVoteCreated  $event
     * @return void
     */
    public function handle(ServerVoteCreated $event)
    {
        $server = Server::find($event->vote->server_id);
        $server->sendDiscordNotification();
    }
}
