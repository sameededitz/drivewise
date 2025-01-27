<?php

namespace App\Observers;

use App\Models\DeviceToken;
use App\Models\Notification;
use App\Notifications\SendNotification;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Support\Facades\Notification as NotificationFacade;

class NotificationObserver implements ShouldHandleEventsAfterCommit
{
    /**
     * Handle the Notification "created" event.
     */
    public function created(Notification $notification): void
    {
        // Fetch all FCM tokens from the device_tokens table
        $deviceTokens = DeviceToken::pluck('fcm_token')->toArray();

        if (!empty($deviceTokens)) {
            // Send the notification via FCM
            NotificationFacade::route('fcm', $deviceTokens)
                ->notify(new SendNotification($notification->title, $notification->body));
        }
    }
}
