<?php

namespace App\Console\Commands;

use App\Jobs\FetchAndStoreCovidDataJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class FetchCovidData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:covid:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It will be fetch current covid data and store it to database';

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
     * @return int
     */
    public function handle()
    {
        Log::info('start');
        FetchAndStoreCovidDataJob::dispatch();
        Log::info('end');
    }
}
