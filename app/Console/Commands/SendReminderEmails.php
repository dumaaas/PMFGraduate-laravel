<?php

namespace App\Console\Commands;
use App\Reminder;
use App\User;
use Illuminate\Console\Command;
use App\Mail\ReminderEmailDigest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Collection;


class SendReminderEmails extends Command
{
    //name and signature of the console command
    protected $signature = 'reminder:emails';

    //the console command description
    protected $description = 'Send email notification to user about reminders.';

    //create new instance
    public function __construct()
    {
        parent::__construct();
    }

    //execute console command
    public function handle()
    {
        //find all reminders with movies where reminder_date is today
        $reminders = Reminder::query()
                    ->with('movie')
                    ->where('reminder_date', now()->format('Y-m-d'))
                    ->where('status', 'pending')
                    ->orderByDesc('user_id')
                    ->get();

        //group them by user
        $data = [];
        foreach($reminders as $reminder) {
            $data[$reminder->user_id][] = $reminder->toArray();
        }

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
