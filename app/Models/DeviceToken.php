<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class DeviceToken extends Model
{
    use Notifiable;

    protected $fillable = ['fcm_token'];

    public static function getAllTokens(): array
    {
        return self::pluck('fcm_token')->toArray();
    }
}
