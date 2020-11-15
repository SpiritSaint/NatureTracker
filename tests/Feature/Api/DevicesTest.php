<?php

namespace Tests\Feature\Api;

use App\Models\Device;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DevicesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function testIndex()
    {
        $user = User::factory()->create();

        $device = $user->devices()->create([
            "name" => Device::factory()->make()->name,
        ]);

        $response = $this->actingAs($user, 'api')->json('GET', '/api/devices');

        $response->assertStatus(200)
            ->assertJsonFragment([
                "name" => $device->name,
            ]);
    }

    /**
     * @return void
     */
    public function testStore()
    {
        $user = User::factory()->create();

        $device = Device::factory()->make();

        $response = $this->actingAs($user, "api")->json("POST", "/api/devices", [
            "name" => $device->name,
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment([
                "name" => $device->name,
            ]);
    }

    /**
     * @return void
     */
    public function testShow()
    {
        $user = User::factory()->create();

        $device = $user->devices()->create([
            "name" => Device::factory()->make()->name,
        ]);

        $response = $this->actingAs($user, "api")->json("GET", "/api/devices/" . $device->id);

        $response->assertStatus(200)
            ->assertJsonFragment([
                "name" => $device->name,
            ]);
    }

    /**
     * @return void
     */
    public function testUpdate()
    {
        $user = User::factory()->create();

        $device = $user->devices()->create([
            "name" => Device::factory()->make()->name,
        ]);

        $newName = "SuperRandomName";

        $response = $this->actingAs($user, "api")->json("PUT", "/api/devices/" . $device->id, [
            "name" => $newName
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment([
                "name" => $newName,
            ]);
    }

    /**
     * @return void
     */
    public function testDestroy()
    {
        $user = User::factory()->create();

        $device = $user->devices()->create([
            "name" => Device::factory()->make()->name,
        ]);

        $response = $this->actingAs($user, "api")->json("DELETE", "/api/devices/" . $device->id);

        $response->assertStatus(200);
    }
}
