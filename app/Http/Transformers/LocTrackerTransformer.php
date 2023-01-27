<?php

namespace App\Http\Transformers;

use Carbon\Carbon;
use App\Models\Shipment;
use Illuminate\Database\Eloquent\Collection;

class LocTrackerTransformer
{
    /**
     * transform the LocTracker data
     *
     * @param array $arrLocTrackerData
     * @return array
     */
    
    public static function transform(array $arrLocTrackerData) : array
    {
        // Get All Active Shipments
        $collActiveShipments = Shipment::active()->get();  

        //transform LocTracker Data
        return collect($arrLocTrackerData['positions'])->map( function($gpsData) use ($collActiveShipments) {
            $filteredShipments = $collActiveShipments->where('gpsdevice_id', $gpsData['deviceId'])->first();
            return [
                "longitude" => $gpsData["lng"],
                "latitude" => $gpsData["lat"],
                "utc_timestamp" => Carbon::createFromTimestamp($gpsData["time"]/1000),
                "shipment_id" => $filteredShipments?->id
            ];
        })->filter(function($locations){
            return $locations['shipment_id'] !== null;
        })->values()->all();
    }
}