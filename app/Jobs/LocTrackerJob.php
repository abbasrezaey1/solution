<?php

namespace App\Jobs;

use App\Models\Gpsposition;
use Illuminate\Support\Arr;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\Transformers\LocTrackerTransformer;
use Illuminate\Queue\{InteractsWithQueue, SerializesModels};
use Illuminate\Contracts\Queue\{ShouldBeUnique, ShouldQueue};
use App\Integrations\LocTracker\LocTrackerHandlerInterface;

class LocTrackerJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    
    private $loctracker;

    public function __construct()
    {
        $this->loctracker = app()->make(LocTrackerHandlerInterface::class);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() : void
    {
        // Get Loction Tracker Data from LocTracker API
        $response = $this->loctracker->get();

        if(!$response->ok()){
            throw new \Exception(Arr::get($response, 'errorDesc', 'invalid api key'));
        }

        // Transform data
        $transformedData = LocTrackerTransformer::tranform($response->json());

        //update device latest tracking location in database
        Gpsposition::insert($transformedData);

        //here we can notify admin by sending email or sending
        //a slack or sms notification which need integrating
        //to integrate in laravel
        logger("LocTracker api GPS positions data successfully updated into Gpsposition table");

    }

     /**
     * Handle a job failure.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function failed(\Throwable $exception)
    {
        logger('loctracker job is failed due to : '.$exception->getMessage());
    }
}
