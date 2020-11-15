<?php

namespace Tests\Feature\Console;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ScheduleTest extends TestCase
{
    /**
     * @return void
     */
    public function testScheduleRun()
    {
        $response = $this->artisan('schedule:run');

        $response->assertExitCode(0);
    }
}
