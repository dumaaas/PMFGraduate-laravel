<?php

namespace App\Http\Controllers;

use App\Acting;
use App\Comment;
use App\Likeable;
use App\MovieList;
use App\Rating;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\User;
use App\Movie;
use App\Cast;
use Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function movieViewDetails($movies) {
        $moviesTotal = Movie::all()->count();
        $moviesNum = $movies->count();
        if(Auth::check()) {
            $watchedCount = MovieList::where('user_id', 'LIKE', Auth::user()->id)->where('type', 'LIKE', 'watched')->count();
            if($watchedCount!=0) {
                $percent = number_format(($moviesNum/$watchedCount)*100,2);
            } else {
                $percent = 0;
            }

            return view('movies.index', [
                'movies'=>$movies,
                'moviesNum'=>$moviesNum,
                'watchedCount'=>$watchedCount,
                'percent'=>$percent,
                'moviesTotal'=>$moviesTotal
            ]);
        } else {

            return view('movies.index', [
                'movies'=>$movies,
                'moviesNum'=>$moviesNum
            ]);
        }
    }

    public function showMovie($movie) {
        //find all ratings for current movie, count ratings and find average rating
        $ratings = Rating::where('movie_id', 'LIKE', $movie->id)->get();
        $ratingNum = (int) $ratings->count();
        $ratingSum=0;
        foreach($ratings as $rating) {
            $ratingSum=$ratingSum+(int) $rating->rating;
        }

        if($ratingNum==0) {
            $rating = 0;
        } else {
            $rating = round($ratingSum/$ratingNum);
        }

    //find all details which are needed to show on movie show page
        $actings = Acting::where('movie_id', '=', $movie->id)->get();
        $stars = Acting::where('movie_id', '=', $movie->id)->latest()->take(3)->get();
        $director = Cast::where('occupation', '=', 'director')->first();
        $sumWatched = MovieList::where('movie_id', '=', $movie->id)->where('type', 'LIKE', 'watched')->count();
        $comments = Comment::where('movie_id', '=', $movie->id)->latest()->paginate(5);
        $sumComments = Comment::where('movie_id', '=', $movie->id)->count();

    //return movie show page with
        return view('movies.show',[
            'movie'=>$movie,
            'actings'=>$actings,
            'director'=>$director,
            'sumWatched'=>$sumWatched,
            'comments'=>$comments,
            'stars'=>$stars,
            'sumComments'=>$sumComments,
            'rating' => $rating,
            'ratingNum' => $ratingNum,
            'ratings' => $ratings
        ]);
    }

    public function showCast($cast) {
        //get all movies where this cast is acting in and count them
        $actings = Acting::where('cast_id', '=', $cast->id)->get();
        $moviesNum = $actings->count();

        //retun cast show view with details
        return view('cast.show',[
            'cast'=>$cast,
            'actings'=>$actings,
            'moviesNum' => $moviesNum,
        ]);
    }


}
