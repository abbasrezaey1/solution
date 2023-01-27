<?php

namespace Tests\Feature\Commands;

use Tests\TestCase;
use App\Models\{Shipment, Gpsposition};
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\LocTrackerCommand;
use Illuminate\Foundation\Testing\{RefreshDatabase, WithFaker};

class LocTrackerCommandTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_dispatch_loctracker_job_through_cosole_commend()
    {
        $shipments = Shipment::factory()
            ->count(5)
            ->create();

        config(['loctracker.mock' => true]);

        Artisan::call(LocTrackerCommand::class);
        
        $this->assertEquals(Shipment::active()->count(), Gpsposition::count());
    }

}
