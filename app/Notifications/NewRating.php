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

    protected $rating;
    public function __construct (Rating $rating)
    {
        $this->rating = $rating;
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
            'data' => [
                'rating' => $this->rating->rating,
                'user' => $this->rating->user,
                'movie' => $this->rating->movie,
            ],
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
