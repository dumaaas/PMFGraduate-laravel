<?php

namespace App\Notifications;

use App\Rating;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Date;

class NewRating extends Notification implements ShouldQueue
{
    use Queueable;


    public function __construct ()
    {
        //
    }


    public function via($notifiable)
    {
        return ['broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'created_at' => Date::now(),
        ]);
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
