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

        // Checking for duplicate IP addresses from servers
        $grouped1 = $servers->mapToGroups(function ($server) {
            return [gethostbyname($server->host) => $server->id];
        });

        $grouped2 = $grouped1->filter(function ($server) {
            return $server->count() > 1;
        });

        if ($grouped2->count() > 0)
        {
            foreach ($grouped2->all() as $ipAddress => $serversDuplicate)
            {
                $serverDuplicate = $serversDuplicate->map(function ($server) {
                    return Server::find($server)->host;
                });
                $this->info('Possible duplicated IP address ' . $ipAddress . ' from servers: ' . implode(', ', $serverDuplicate->all()));
            }
        }

        // Checking for offline/VPN-required servers
        foreach ($servers as $server)
        {
            if (strpos($server->name, 'crack') == true || strpos($server->description, 'crack') == true || strpos($server->description, 'hamachi') == true || strpos($server->description, 'hamachi') == true)
            {
                $this->info('Possible offline/VPN-required server: ' . $server->host);
            }
        }

        $this->info('Finished scanning servers!');
    }
}
