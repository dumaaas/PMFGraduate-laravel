<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
//---------------------------SHOW NOTIFICATIONS--------------------------------\\
    public function notifications()
    {
        //get all new followed notifications for user
        $notifications = Auth::user()->notifications()->where('type', 'App\Notifications\UserFollowed')->get();

        //get all new movie notifications for user
        $movieNotifications = Auth::user()->notifications()->where('type', 'App\Notifications\NewMovie')->get();

        return view('users.notifications', [
            'notifications' => $notifications,
            'user' => Auth::user(),
            'movieNotifications' => $movieNotifications
        ]);
    }
//-----------------------------------------------------------------------------\\

}
