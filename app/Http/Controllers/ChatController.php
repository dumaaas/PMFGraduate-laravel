<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\User;
use App\Chat;
use Auth;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function show(User $user)
    {
        return Chat::where('sender_user_id', 'LIKE', Auth::user()->id)->where('receiver_user_id', 'LIKE', $user->id)->orWhere('sender_user_id', 'LIKE', $user->id)->where('receiver_user_id', 'LIKE', Auth::user()->id)->get();
    }

    public function sendMessage(User $user, $message)
    {
        $chat = new Chat();
        $chat->sender_user_id = Auth::user()->id;
        $chat->receiver_user_id = $user->id;
        $chat->message = $message;

        $chat->save();

        broadcast(new MessageSent($chat))->toOthers();

        return $chat;
    }
}
