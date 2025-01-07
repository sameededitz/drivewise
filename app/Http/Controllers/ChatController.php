<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    public function chats()
    {
        /** @var \App\Models\User $user **/
        $user = Auth::user();
        $chats = $user->chat()->with('messages')->get();

        return response()->json([
            'status' => true,
            'chats' => $chats
        ]);
    }

    public function createChat(Request $request)
    {
        /** @var \App\Models\User $user **/
        $user = Auth::user();
        $chat = $user->chat()->create([
            'title' => $request->title
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Chat created successfully',
            'chat' => $chat
        ]);
    }

    public function saveMessage(Request $request, Chat $chat)
    {
        /** @var \App\Models\User $user **/
        $user = Auth::user();

        if ($chat->user_id !== $user->id) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'message' => 'required|string',
            'sender' => 'required|in:ai,user',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all()
            ], 400);
        }

        if (!$chat) {
            return response()->json([
                'status' => false,
                'message' => 'Chat not found'
            ], 404);
        }

        $messages = $chat->messages()->create([
            'message' => $request->message,
            'sender' => $request->sender,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Message saved successfully',
            'chat' => $chat,
            'message_data' => $messages
        ]);
    }

    public function destroy(Chat $chat)
    {
        if (!$chat) {
            return response()->json([
                'status' => false,
                'message' => 'Chat not found'
            ], 404);
        }

        /** @var \App\Models\User $user **/
        $user = Auth::user();
        if ($chat->user_id !== $user->id) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
            ], 403);
        }

        $chat->delete();
        return response()->json([
            'status' => true,
            'message' => 'Chat deleted successfully'
        ]);
    }
}
