<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\User;
use App\Reminder;

class ReminderController extends Controller
{
//---------------------SET REMINDER FOR MOVIE-----------------------------\\
    public function store(Request $request, Movie $movie, User $user) 
    {
        //save new reminder for movie
        $reminder = new Reminder();
        $reminder->status='pending';
        $reminder->reminder_date = request('reminder');
        $reminder->user_id=$user->id;
        $reminder->movie_id=$movie->id;
        $reminder->save();

        //flash success message if user seted reminder cast for movie
        flash('You successfuly set reminder for '.$reminder->reminder_date.'!')->success();

        //return back to the movie show view
        return back();
    }
//-------------------------------------------------------------------------\\

}
