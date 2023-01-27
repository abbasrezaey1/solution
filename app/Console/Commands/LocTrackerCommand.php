<?php

namespace App\Console\Commands;

use App\Jobs\LocTrackerJob;
use Illuminate\Console\Command;

class LocTrackerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'loctracker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get GPS position data from LocTracker API';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //Check if LocTracker service is active from config
        $is_active = config('loctracker.active');

        if(!$is_active) {
            $this->error('the loctracker service is not available contact Site Administrator');
            return false;
        } 

        $this->info('loctracker queue job starting and dispatching.......');

        LocTrackerJob::dispatch();        

        $this->info('loctracker queue job successfully dispatched');
    }
}
