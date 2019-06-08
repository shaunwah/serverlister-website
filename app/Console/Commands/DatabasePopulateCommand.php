<?php

namespace App\Console\Commands;

use App\User;
use App\Country;
use App\Version;
use App\ServerType;
use App\Imports\CountriesImport;
use App\Imports\VersionsImport;
use App\Imports\ServerTypesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Console\Command;

class DatabasePopulateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:populate';

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
        if (User::find(1))
        {
            if (Country::count() == 0)
            {
                $this->info('Starting to populate countries...');
                Excel::import(new CountriesImport, resource_path('csv/countries.csv'));
                $this->info('Populated countries!');
            }
            else
            {
                $this->info('Countries database can only be populated if empty!');
            }

            if (Version::count() == 0)
            {
                $this->info('Starting to populate server versions...');
                Excel::import(new VersionsImport, resource_path('csv/server_versions.csv'));
                $this->info('Populated server versions!');
            }
            else
            {
                $this->info('Server versions database can only be populated if empty!');
            }


            if (ServerType::count() == 0)
            {
                $this->info('Starting to populate server types...');
                Excel::import(new ServerTypesImport, resource_path('csv/server_types.csv'));
                $this->info('Populated server types!');
            }
            else
            {
                $this->info('Server types database can only be populated if empty!');
            }
        }
        else
        {
            $this->info('A user has to be registered first!');
        }
    }
}
