<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use Auth;
use App\Reminder;

class ReminderController extends Controller
{
//---------------------SET REMINDER FOR MOVIE-----------------------------\\
    public function store(Request $request, Movie $movie, $date)
    {
        //save new reminder for movie
        $reminder = new Reminder();
        $reminder->status='pending';
        $reminder->reminder_date = $date;
        $reminder->user_id=Auth::id();
        $reminder->movie_id=$movie->id;
        $reminder->save();

        //return back to the movie show view
        return ['message' => 'You successfuly set reminder for '.$reminder->reminder_date.'!'];
    }
//-------------------------------------------------------------------------\\

}
