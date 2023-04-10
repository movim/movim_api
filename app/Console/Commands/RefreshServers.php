<?php

namespace App\Console\Commands;

use App\Server;
use Illuminate\Console\Command;

class RefreshServers extends Command
{
    protected $signature = 'app:refresh-servers';
    protected $description = 'Refresh the existing servers';

    public function handle()
    {
        foreach (Server::all() as $server) {
            $server->requestRefresh($server->domain);
            $this->info($server->domain . ' refreshed');
        }
    }
}
