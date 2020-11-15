<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Device extends Model
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
        "user_id",
        "name",
        "description",
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
     * The device has many events.
     *
     * @return HasMany
     */
    public function events()
    {
        return $this->hasMany(Event::class, "device_id", "id");
    }
}
