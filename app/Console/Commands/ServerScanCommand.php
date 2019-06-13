<?php

namespace App\Console\Commands;

use App\Server;
use Illuminate\Console\Command;

class ServerScanCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'server:scan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scans and flags malicious/suspicious servers in the database.';

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
        $this->info('Starting to scan servers...');
        $servers = Server::all();

        // Checks if IP addresses are duplicated
        $this->info('Checking for duplicated server IP addresses...');
        $grouped1 = $servers->mapToGroups(function ($server) {
            return [(gethostbyname($server->host) . ':' . $server->port) => $server->id];
        });

        $grouped2 = $grouped1->filter(function ($server) {
            return $server->count() > 1;
        });

        if ($grouped2->count() > 0)
        {
            foreach ($grouped2->all() as $ipAddress => $server)
            {
                $this->info($ipAddress . ' has duplicated server IDs: ' . $server);
            }
        }
        else
        {
                $this->info('No duplicated server IP addresses found.');
        }

        $this->info('Finished scanning servers!');
    }
}
