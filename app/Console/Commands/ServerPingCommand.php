<?php

namespace App\Console\Commands;

use App\Server;
use App\ServerPing;
use Illuminate\Console\Command;

class ServerPingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'server:ping';

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
        $this->info('Starting to ping servers...');
        $servers = Server::orderBy('rank', 'asc')->get();
        foreach ($servers as $server)
        {
            $ping = new ServerPing;
            $ping->pingServer($server);
            $this->info('Pinged ' . $server->name . '!');
        }
        $this->info('Finished pinging servers!');
    }
}
