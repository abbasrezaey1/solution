<?php

return [

    /*
    |--------------------------------------------------------------------------
    | LocTracker Settings
    |--------------------------------------------------------------------------
    */

    'mock' => env('LOCTRACKER_MOCK', false),
    "base_url" => "https://loctracker.com/LoctrackerFieldService/REST",
    "version" => "/v1/third-party/",
    "api_key" => env("LOCTRACKER_API_KEY", "ORWTvqxQsaavHjl8Z0dW4nppQxOgK5jZRe1kGRlm"),
    'active' => env("LOCTRACKER_SERVICE_ACTIVE", true),
    'timeout' => env("LOCTRACKER_API_TIMEOUT", 5)
];
