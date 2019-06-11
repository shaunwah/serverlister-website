<?php

namespace App\Console\Commands;

use App\Server;
use Illuminate\Console\Command;

class ServerRankCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'server:rank';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Starting to rank servers...');
        $server = new Server;
        $servers = $server->all();
        $scoreData = $server->retrieveScores();
        $rankData = $server->retrieveRanks();
        foreach ($servers as $server)
        {
            $voteCount = (isset($scoreData['vote_count'][$server->id]) ? $scoreData['vote_count'][$server->id] : 0);
            $pingTotalCount = (isset($scoreData['ping_count']['total'][$server->id]) ? $scoreData['ping_count']['total'][$server->id] : 0);
            $pingOnlineCount = (isset($scoreData['ping_count']['online'][$server->id]) ? $scoreData['ping_count']['online'][$server->id] : 0);
            $playerCount = (isset($scoreData['player_count'][$server->id]) ? $scoreData['player_count'][$server->id] : 0);
            $uptimePercentage = $pingOnlineCount / $pingTotalCount;

            $score = ((5/6) * ((0.025 * $playerCount) + (1.5 * $voteCount) + (3 * $uptimePercentage))) / 4;

            $attributes = [
                'score' => $score,
                'rank' => $rankData->find($server->id)->rank,
            ];

            $this->info('Ranked ' . $server->name . '! (Uptime: ' . $uptimePercentage * 100 . '%, Players: ' . $playerCount . ', Votes: ' . $voteCount . ')');

            $server->update($attributes);
        }
        $this->info('Finished ranking servers!');
    }
}
