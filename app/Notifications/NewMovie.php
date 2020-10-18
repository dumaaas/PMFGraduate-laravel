<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Movie;

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
        return ['database'];
    }

    //sending data array of movies details to Notification table
    public function toDatabase($notifiable)
    {
        return [
            'movie_id' => $this->movie->id,
            'movie_name' => $this->movie->name,
            'movie_genre' => $this->movie->genre,
            'movie_releaseYear' => $this->movie->releaseYear,
            'movie_avatar' => $this->movie->avatar
        ];
    }

    public function toArray($notifiable)
    {
        return [
            
        ];
    }
}
