<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\User;
use Illuminate\Support\Facades\Date;

class UserFollowed extends Notification implements ShouldQueue
{
    use Queueable;

    //create new notification instance
    protected $follower;

    public function __construct(User $follower)
    {
        $this->follower = $follower;
    }

    //sending notification via database
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    //sending data array of follower details to Notification table
    public function toDatabase($notifiable)
    {
       return [
           'id' => $this->follower->id,
           'name' => $this->follower->firstName.$this->follower->lastName,
           'avatar' => $this->follower->avatar
       ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'data' => [
                'id' => $this->follower->id,
                'name' => $this->follower->firstName.$this->follower->lastName,
                'avatar' => $this->follower->avatar
            ],
            'created_at' => Date::now(),
        ]);
    }

    public function toArray($notifiable)
    {
        return [

        ];
    }
}
