<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    use HasFactory, Uuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "device_id",
        "data",
    ];

    /**
     * The event belongs to device.
     *
     * @return BelongsTo
     */
    public function device()
    {
        return $this->belongsTo(Device::class, "device_id", "id");
    }
}
