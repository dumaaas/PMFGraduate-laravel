<?php

namespace App\Http\Controllers;

use App\Notifications\NewRating;
use App\Rating;
use App\Movie;
use App\User;
use Illuminate\Http\Request;
use Auth;


class RatingController extends Controller
{
    public function index(Movie $movie) {
        $ratings = $movie->rating()->with('user')->get();
        return $ratings;
    }

    public function getRatings() {
        return Rating::latest()->get();
    }

//------------------------------ADD NEW RATING--------------------------------------\\
    public function store(Request $request, Movie $movie, $rating)
    {

        $r = Rating::where('movie_id', $movie->id)->where('user_id', Auth::id())->first();
        if($r) {
            $r->update([
                'rating' => $rating
            ]);
        } else {

            $newR = Rating::create([
                'movie_id' => $movie->id,
                'user_id' => Auth::id(),
                'rating' => $rating,
                'review' => 'hehehe'
            ]);

            $users = User::where('role', 'LIKE', 'admin')->get();
            foreach ($users as $u) {
                $u->notify(new NewRating($newR));
            }
        }
        return ['message' => 'New movie rating'.$rating];
    }
//----------------------------------------------------------------------------------\\

//-------------------------------DELETE RATING---------------------------------------\\
    public function destroy($movieId, $userId)
    {
        //delete rating and return back to the rating table in dashboard
        Rating::where('movie_id', 'LIKE', $movieId)->where('user_id', 'LIKE', $userId)->delete();
        return ['message' => 'Rating has been deleted!'];
    }
//----------------------------------------------------------------------------------\\

}
