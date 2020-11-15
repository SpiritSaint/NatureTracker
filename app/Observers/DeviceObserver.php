<?php

namespace App\Observers;

use App\Models\Device;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class DeviceObserver
{
    /**
     * Handle the Device "creating" event.
     *
     * @param  \App\Models\Device  $device
     * @return void
     */
    public function creating(Device $device)
    {
        $device->api_token = hash('sha256', Str::random(60));
    }
}
