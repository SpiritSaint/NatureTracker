<?php

namespace Tests\Feature\Api;

use App\Models\Device;
use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventsTest extends TestCase
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

        $event = $device->events()->create([
            "data" => Event::factory()->make()->data,
        ]);

        $response = $this->actingAs($user, 'api')->json('GET', '/api/events');

        $response->assertStatus(200)
            ->assertJsonFragment([
                "data" => $event->data,
            ]);
    }

    /**
     * @return void
     */
    public function testStore()
    {
        $user = User::factory()->create();

        $device = $user->devices()->create([
            "name" => Device::factory()->make()->name,
        ]);

        $response = $this->actingAs($user, "api")->json("POST", "/api/events", [
            "device_id" => $device->id,
            "data" => [
                "temperature" => 7
            ]
        ]);

        $response->assertStatus(201)
            ->assertJsonFragment([
                "device_id" => $device->id,
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

        $event = $device->events()->create([
            "data" => Event::factory()->make()->data,
        ]);

        $response = $this->actingAs($user, "api")->json("GET", "/api/events/" . $event->id);

        $response->assertStatus(200)
            ->assertJsonFragment([
                "data" => $event->data,
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

        $event = $device->events()->create([
            "data" => Event::factory()->make()->data,
        ]);

        $newTemperature = 17;

        $response = $this->actingAs($user, "api")->json("PUT", "/api/events/" . $event->id, [
            "data" => [
                "temperature" => $newTemperature
            ]
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment([
                "data" => [
                    "temperature" => $newTemperature
                ]
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

        $event = $device->events()->create([
            "data" => Event::factory()->make()->data,
        ]);

        $response = $this->actingAs($user, "api")->json("DELETE", "/api/events/" . $event->id);

        $response->assertStatus(200);
    }
}
