<?php

namespace App\Integrations\LocTracker;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response as ClientResponse;

class LocTrackerHandler implements LocTrackerHandlerInterface
{
    
    /**
     * get All LocTracker Data.
     *
     * @param  null
     * @return array
     */
    public function get() : ClientResponse
    {
        return Http::get($this->url(), [
                'key' => config('loctracker.api_key')
            ]);//->timeout(config('loctracker.timeout'));
    }

    /**
     * get LocTracker API URL.
     *
     * @param  string $type = 'positions'
     * @return string
     */
    public function url(string $type = 'positions') : string
    {
        $baseUrl = config('loctracker.base_url');
        $version = config('loctracker.version');

        return "{$baseUrl}{$version}{$type}";
    }
}
