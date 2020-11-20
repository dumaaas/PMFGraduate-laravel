<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\MovieList;
use App\User;
use Illuminate\Http\Request;

class MovieListController extends Controller
{
    //------------------------SHOW MOVIE LIST-----------------------------\\
    public function index(User $user, $type)
    {

        //authorize who can see user favorite list
        $this->authorize('checkFollow', $user);

        //find user favorite list
        $movielist = MovieList::where('user_id', '=', $user->id)->where('type', 'LIKE', $type)->paginate(10);

        //return favorite view page with details
        return view('users.movielist',[
            'user'=>$user,
            'movielist'=>$movielist,
            'type' => $type
        ]);
    }
//------------------------------------------------------------------------\\
}
