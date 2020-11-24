<?php

namespace App\Console\Commands;
use App\Reminder;
use App\User;
use Illuminate\Console\Command;
use App\Mail\ReminderEmailDigest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;


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

        Queue::push(new \App\Jobs\SendReminderEmails($data));
    }
}
