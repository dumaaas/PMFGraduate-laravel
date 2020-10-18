<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\User;

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
        return ['database'];
    }
   
    //sending data array of follower details to Notification table
    public function toDatabase($notifiable)
    {
       return [
           'follower_id' => $this->follower->id,
           'follower_firstName' => $this->follower->firstName,
           'follower_lastName' => $this->follower->lastName,
           'follower_avatar' => $this->follower->avatar
       ];
    }

    public function toArray($notifiable)
    {
        return [
            
        ];
    }
}
