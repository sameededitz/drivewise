<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function store(Request $request)
    {
        // Validate the uploaded image
        $validator = Validator::make($request->all(), [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20420',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all()
            ], 400);
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Add or replace the license image in the user's media collection
        if ($request->hasFile('image')) {
            $user->addMedia($request->file('image')->getRealPath())
                ->usingFileName($request->file('image')->getClientOriginalName())
                ->toMediaCollection('license');
        }

        return response()->json([
            'status' => true,
            'message' => 'License image stored successfully!',
            'license_url' => $user->getFirstMediaUrl('license')
        ]);
    }

    public function show()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Get the license image URL from the media collection
        $licenseUrl = $user->getFirstMediaUrl('license');

        return response()->json([
            'status' => true,
            'message' => 'License image retrieved successfully!',
            'license_url' => $licenseUrl,
        ]);
    }
}
