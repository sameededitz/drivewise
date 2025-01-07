<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReminderController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user **/
        $user = Auth::user();
        $reminders = $user->reminders()->get();
        return response()->json([
            'status' => true,
            'reminders' => $reminders
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'date' => 'required|date|after:now',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all()
            ], 400);
        }

        /** @var \App\Models\User $user **/
        $user = Auth::user();

        $reminder = $user->reminders()->create([
            'title' => $request->title,
            'date' => $request->date,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Reminder created successfully',
            'reminder' => $reminder
        ], 201);
    }

    public function destroy($id)
    {
        $reminder = Reminder::findOrFail($id);
        if (!$reminder) {
            return response()->json([
                'status' => false,
                'message' => 'Reminder not found'
            ], 404);
        }

        $reminder->delete();
        return response()->json([
            'status' => true,
            'message' => 'Reminder deleted successfully'
        ]);
    }
}
