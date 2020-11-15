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
     * The model primary key name.
     *
     * @var string
     */
    protected $primaryKey = "id";

    /**
     * The model has incrementing primary key.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The model key type.
     *
     * @var string
     */
    public $keyType = "string";

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
     * The attributes that are casted.
     *
     * @var string[]
     */
    protected $casts = [
        "data" => "array",
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return "id";
    }

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
