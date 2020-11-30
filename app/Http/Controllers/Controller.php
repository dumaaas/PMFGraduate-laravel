<?php

namespace App\Http\Controllers;

use App\Acting;
use App\Comment;
use App\Likeable;
use App\MovieList;
use App\Rating;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\User;
use App\Movie;
use App\Cast;
use Auth;
use Illuminate\Support\Facades\Cache;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function movieViewDetails($movies) {
        $moviesTotal = Cache::remember('moviesTotal', Carbon::now()->addDay(), function() {
           return Movie::all()->count();
        });
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
