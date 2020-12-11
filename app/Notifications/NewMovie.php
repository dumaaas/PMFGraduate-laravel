<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Movie;
use Illuminate\Support\Facades\Date;

class NewMovie extends Notification implements ShouldQueue
{
    use Queueable;

    //create new notification instance
    protected $movie;

    public function __construct(Movie $movie)
    {
        $this->movie = $movie;
    }

    //sending notification via database
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    //sending data array of movies details to Notification table
    public function toDatabase($notifiable)
    {
        return [
            'id' => $this->movie->id,
            'name' => $this->movie->name,
            'avatar' => $this->movie->avatar,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'data' => [
                'id' => $this->movie->id,
                'name' => $this->movie->name,
                'genre' => $this->movie->genre,
                'releaseYear' => $this->movie->releaseYear,
                'avatar' => $this->movie->avatar,
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
