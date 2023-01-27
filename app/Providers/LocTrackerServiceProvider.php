<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Integrations\LocTracker\{LocTrackerHandler, LocTrackerHandlerInterface, LocTrackerHandlerMock};

class LocTrackerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(LocTrackerHandlerInterface::class, function ($app) {
            $shouldMock = $app['config']->get('loctracker.mock');

            if ($shouldMock) {
                return new LocTrackerHandlerMock();
            }

            return new LocTrackerHandler();
        });
    }
}
