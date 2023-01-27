<?php

namespace App\Integrations\LocTracker;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Client\Response as ClientResponse;

interface LocTrackerHandlerInterface
{
    public function get(): ClientResponse|JsonResponse;

    public function url(string $type = 'positions') : string;
}
