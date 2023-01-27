<?php

namespace App\Integrations\LocTracker;

use Carbon\Carbon;
use App\Models\Shipment;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response as ClientResponse;
use Illuminate\Http\JsonResponse;

class LocTrackerHandlerMock implements LocTrackerHandlerInterface
{
    /**
     * get All LocTracker Data.
     *
     * @param  null
     * @return array
     */
    public function get() : ClientResponse
    {
        $data=[];
        $collActiveShipments = Shipment::active()->get();  

        foreach($collActiveShipments as $shipment){
            $data['positions'][] = [
                  "vehRegNumber" => "SCZ-98304",
                  "lng" => 7.8120666,
                  "heading" => 242,
                  "time" => Carbon::now()->timestamp,
                  "deviceId" => $shipment->gpsdevice_id,
                  "ignitionState" => Arr::random(['ON', 'OFF']),
                  "speed" => 0,
                  "lat" => 48.5790966,
            ];
        }

        $data["key"] = "ORWTvqxQsaavHjl8Z0dW4nppQxOgK5jZRe1kGRlm";

        Http::fake([
            'loctrackermock.com' => Http::response($data, 200)
        ]);

        return Http::get('http://loctrackermock.com');

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
