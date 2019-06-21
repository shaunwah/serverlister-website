<?php

namespace App\Listeners;

use App\Server;
use App\Events\ServerVoteCreated;
use App\Minecraft\Votifier2\Server as Votifier2Server;
use App\Minecraft\Votifier2\Vote as Votifier2Vote;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendVoteToServer
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
        if ($server->voting_service_enabled)
        {
            try
            {
                $votifierServer = new Votifier2Server(gethostbyname($server->voting_service_host), $server->voting_service_port, decrypt($server->voting_service_token));
                $votifierVote = new Votifier2Vote('serverlister.io', $event->vote->username, $event->vote->ip_address, null);
                $votifierServer->sendVote($votifierVote);
            }
            catch (Exception $e)
            {
                report($e);
                return false;
            }
        }
    }
}
