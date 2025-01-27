<?php

namespace App\Models;

use App\Observers\NotificationObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(NotificationObserver::class)]
class Notification extends Model
{
    protected $fillable = ['title', 'body'];
}
