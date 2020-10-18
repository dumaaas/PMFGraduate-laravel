<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\User;
use App\Movie;
use App\Watched;
use App\Favorite;
use App\Cast;
use Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function movieViewDetails($movies) {
        $moviesTotal = Movie::all()->count();
        $moviesNum = $movies->count();
        if(Auth::check()) {
            $watchedCount = Watched::where('user_id', 'LIKE', Auth::user()->id)->count();
            $percent = number_format(($moviesNum/$watchedCount)*100,2);

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
}
