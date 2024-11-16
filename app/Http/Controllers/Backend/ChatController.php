<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Friendship;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function updateUserSocketId(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'socket_id' => 'required|string',
        ]);

        $user = User::where('id', $request->user_id)->first();
        $user->socket_id = $request->socket_id;
        $user->save();
        return response()->json(['message' => 'User socket ID updated successfully.'], 200);
    }

    public function deleteUserSocketId(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();
        $user->socket_id = null;
        $user->save();
        return response()->json(['message' => 'User socket ID deleted successfully.'], 200);
    }





    public function index()
    {
        $chatlist = Friendship::with('receiver:id,first_name,last_name,profile_photo,socket_id')->where('sender_id', Auth::user()->id)->get();
        $messages = Message::with('sender:id,first_name,last_name', 'receiver:id,first_name,last_name')->get();
        return view('backend.pages.chat.index', compact([
            'chatlist',
            'messages',
        ]));
    }

    public function saveMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);
        Message::create([
            'sender_id' => $request->sender_id ?? 3,
            'receiver_id' => $request->receiver_id ?? 4,
            'message' => $request->message,
        ]);
        return back();
    }
}
