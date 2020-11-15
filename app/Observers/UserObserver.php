<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class UserObserver
{
    /**
     * Handle the User "creating" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function creating(User $user)
    {
        $user->api_token = hash('sha256', Str::random(60));
    }
}
