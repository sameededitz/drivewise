<?php

namespace App\Http\Controllers;

use App\Models\DeviceToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeviceTokenController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fcm_token' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all()
            ], 400);
        }

        $exists = DeviceToken::where('fcm_token', $request->fcm_token)->exists();

        if ($exists) {
            return response()->json([
                'status' => false,
                'message' => 'This FCM token already exists.',
            ], 409); // 409 Conflict HTTP status code
        }

        DeviceToken::create(['fcm_token' => $request->fcm_token]);

        return response()->json([
            'status' => true,
            'message' => 'FCM token added successfully!',
        ]);
    }
}
