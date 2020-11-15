<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Uuid;

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
        "name",
        "email",
        "password",
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        "password",
        "remember_token",
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        "email_verified_at" => "datetime",
    ];

    /**
     * The user has many devices.
     *
     * @return HasMany
     */
    public function devices()
    {
        return $this->hasMany(Device::class, "user_id", "id");
    }
}
