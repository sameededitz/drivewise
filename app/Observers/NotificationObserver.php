<?php

namespace App\Observers;

use App\Models\DeviceToken;
use App\Models\Notification;
use App\Notifications\SendNotification;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification as NotificationFacade;
use NotificationChannels\Fcm\FcmChannel;

class NotificationObserver implements ShouldHandleEventsAfterCommit
{
    /**
     * Handle the Notification "created" event.
     */
    public function created(Notification $notification): void
    {
        // Fetch all FCM tokens from the device_tokens table
        $deviceTokens = DeviceToken::getAllTokens();

        if (!empty($deviceTokens)) {
            // Send the notification via FCM
            try {
                // Optionally, chunk the tokens if you have many (e.g., 1000)
                $chunkSize = 500;
                $chunks = array_chunk($deviceTokens, $chunkSize);

                foreach ($chunks as $chunk) {
                    NotificationFacade::route(FcmChannel::class, $chunk)
                        ->notify(new SendNotification($notification->title, $notification->body));
                }

                Log::channel("notification")->info("Notification sent to " . count($deviceTokens) . " devices.");
            } catch (\Exception $e) {
                Log::channel("notification")->error("Error sending notification: " . $e->getMessage());
            }
        } else {
            Log::channel("notification")->warning("No device tokens found");
        }
    }
}
