<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReminderEmailDigest extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    //create new instance
    private $reminders;

    public function __construct($reminders)
    {
        $this->reminders = $reminders;
    }

    //build the message
    public function build()
    {
        //return markdown emails.reminder-digest view with details
        //this markdown is look of our email
        return $this->markdown('emails.reminder-digest')
        ->with('reminders', $this->reminders);
    }
}
