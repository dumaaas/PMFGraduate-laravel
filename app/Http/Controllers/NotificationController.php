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
        $notifications = Auth::user()->notifications()->latest()->get();

        //get all new movie notifications for user
        return view('users.notifications', [
            'notifications' => $notifications,
            'user' => Auth::user(),
        ]);
    }
//-----------------------------------------------------------------------------\\

    public function getNotifications()
    {
        $oldNotifications = Auth::user()->readNotifications()->latest()->take(3)->get();
        $newNotifications = Auth::user()->unreadNotifications()->latest()->get();
        return response()->json([
            'oldNotifications' => $oldNotifications,
            'newNotifications' => $newNotifications
        ]);
    }

    public function markAsReadNotifications()
    {
        Auth::user()->unreadNotifications->markAsRead();
        $oldNotifications = Auth::user()->readNotifications()->latest()->take(3)->get();
        $newNotifications = Auth::user()->unreadNotifications()->latest()->take(3)->get();
        return response()->json([
            'newNotifications' => $newNotifications,
            'oldNotifications' => $oldNotifications,
        ]);
    }


}
