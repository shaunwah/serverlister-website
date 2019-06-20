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
    protected $description = 'Ranks all servers in the database.';

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
    public function handle(Server $server)
    {
        $this->info('Starting to rank servers...');

        $server = new Server;
        $data = $server->getAllStatistics();
        $scores = $server->calculateAllScores($data);
        $ranks = $server->calculateAllRanks($scores);

        foreach ($scores as $id => $score)
        {
            $data = [
                'rank' => $ranks[$id],
                'score' => $score,
            ];

            if ($server->find($id)->update($data))
            {
                $this->info("Updated rank and score for server ID {$id}!");
            }
        }

        $this->info('Finished ranking servers!');
    }
}
