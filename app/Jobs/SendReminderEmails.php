<?php

namespace App\Jobs;

use App\Mail\ReminderEmailDigest;
use App\Reminder;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendReminderEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = $this->data;

        //send email remainder to each user
        foreach($data as $userId => $reminders) {
            $this->sendEmailToUser($userId, $reminders);
        }
    }

    //function for sending email to user
    private function sendEmailToUser($userId, $reminders) {
        //find user
        $user = User::find($userId);

        //send email to user, with RemainderEmailDiger (this class is showing markdown for email and send data to markdown)
        Mail::to($user)->send(new ReminderEmailDigest($reminders));
    }

}
