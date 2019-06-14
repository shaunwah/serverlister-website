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

        $this->info('Checking for duplicated server IP addresses...');
        $grouped1 = $servers->mapToGroups(function ($server) {
            return [(gethostbyname($server->host) . ':' . $server->port) => $server->id];
        });

        $grouped2 = $grouped1->filter(function ($server) {
            return $server->count() > 1;
        });

        if ($grouped2->count() > 0)
        {
            foreach ($grouped2->all() as $ipAddress => $serversDuplicate)
            {
                $serverDuplicate = $serversDuplicate->map(function ($server) {
                    return Server::find($server)->name;
                });
                $this->info('Servers ' . implode(', ', $serverDuplicate->all()) . ' both point to the same IP address at ' . $ipAddress . '.');
            }
        }

        $this->info('Checking for cracked servers...');
        foreach ($servers as $server)
        {
            if (strpos($server->name, 'crack') == true || strpos($server->description, 'crack') == true)
            {
                $this->info('Server ' . $server->name . ' may possibly be a cracked server.');
            }
        }

        $this->info('Finished scanning servers!');
    }
}
