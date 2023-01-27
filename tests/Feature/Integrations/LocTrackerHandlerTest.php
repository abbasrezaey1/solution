<?php

namespace Tests\Feature\Integrations;

use Tests\TestCase;
use App\Integrations\LocTracker\LocTrackerHandler;
use Illuminate\Foundation\Testing\{WithFaker, RefreshDatabase};

class LocTrackerHandlerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }


    /**
     * @test
     */
    public function is_loctracker_api_working_successfully()
    {
        $response = (new LocTrackerHandler())->get();

        $this->assertTrue($response->ok());
    }

    /**
     * @test
     */
    public function is_loctracker_api_response_has_data()
    {
        $response = (new LocTrackerHandler())->get();
        
        $this->assertEquals(true, $response->ok());
        $this->assertNotEquals(0, count($response->json()['positions']));
    }

    
}
