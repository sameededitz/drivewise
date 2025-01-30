<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\DeviceToken;
use App\Notifications\SendNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification as NotificationFacade;
use NotificationChannels\Fcm\FcmChannel;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::all();
        return view('admin.all-notifications', compact('notifications'));
    }

    public function store(Request $request)
    {
        $deviceTokens = DeviceToken::getAllTokens();

        if (!empty($deviceTokens)) {
            // Send the notification via FCM
            try {
                // Optionally, chunk the tokens if you have many (e.g., 1000)
                $chunkSize = 500;
                $chunks = array_chunk($deviceTokens, $chunkSize);

                foreach ($chunks as $chunk) {
                    NotificationFacade::route(FcmChannel::class, $chunk)
                        ->notify(new SendNotification('hello', 'world'));
                }

                Log::channel("notification")->info("Notification sent to " . count($deviceTokens) . " devices.");
            } catch (\Exception $e) {
                Log::channel("notification")->error("Error sending notification: " . $e->getMessage());
            }
        } else {
            Log::channel("notification")->warning("No device tokens found");
        }

        return 'Notification sent successfully!';

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:3|max:255',
            'body' => 'required|max:2000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->with('form', 'error');
        }

        Notification::create($request->all());

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Notification created successfully',
        ]);
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();
        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Notification deleted successfully',
        ]);
    }

    public function notifications()
    {
        $notifications = Notification::all();
        return response()->json([
            'status' => true,
            'message' => 'Notifications retrieved successfully!',
            'notifications' => $notifications,
        ]);
    }
}
