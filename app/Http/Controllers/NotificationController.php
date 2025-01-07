<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::all();
        return view('admin.all-notifications', compact('notifications'));
    }

    public function store(Request $request)
    {
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
}
