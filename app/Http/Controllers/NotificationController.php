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
        $notifications = Auth::user()->notifications()->get();

        //get all new movie notifications for user
        return view('users.notifications', [
            'notifications' => $notifications,
            'user' => Auth::user(),
        ]);
    }
//-----------------------------------------------------------------------------\\

    public function getNotifications()
    {
        $notifications = Auth::user()->notifications()->latest()->get();
        return response()->json($notifications);
    }


}
