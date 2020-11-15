<?php

namespace Tests\Feature\Framework;

use App\Models\Device;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function testAuthenticateMiddleware()
    {
        $user = User::factory()->create();

        $device = $user->devices()->create([
            "name" => Device::factory()->make()->name,
        ]);

        $response = $this->actingAs($user)->get("/api/devices/" . $device->id);

        $response->assertRedirect("/");
    }
}
