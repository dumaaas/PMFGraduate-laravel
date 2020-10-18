<?php

namespace App\Http\Controllers;

use App\Rating;
use App\Movie;
use Illuminate\Http\Request;
use Auth;


class RatingController extends Controller
{
//------------------------------ADD NEW RATING--------------------------------------\\
    public function store(Request $request, Movie $movie)
    {
        //validate all data and save new rating
        request()->validate([
            'rating'=>'required',
            'review'=>'required'
        ]);

        $rating = new Rating();

        $rating->rating=request('rating');
        $rating->review=request('review');
        $rating->user_id=Auth::user()->id;
        $rating->movie_id=$movie->id;

        $rating->save();
        
        //return back to the movie page
        return back();
    }
//----------------------------------------------------------------------------------\\

//-------------------------------DELETE RATING---------------------------------------\\
    public function destroy($movieId, $userId)
    {
        //delete rating and return back to the rating table in dashboard
        $rating = Rating::where('movie_id', 'LIKE', $movieId)->where('user_id', 'LIKE', $userId)->delete();
        return back();
    }
//----------------------------------------------------------------------------------\\

}
