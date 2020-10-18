<?php

namespace App\Http\Controllers;

use App\Watchlist;
use App\User;
use Illuminate\Http\Request;
use Auth;

class WatchlistController extends Controller
{
//---------------------------SHOW WATCHLIST LIST--------------------------------\\
    public function index(User $user)
    {
        //authorize who can see user watchlist
        $this->authorize('checkFollow', $user);

        //find user watchlist
        $watchlists = Watchlist::where('user_id', '=', $user->id)->paginate(10);

        //return watchlist view page with details
        return view('users.watchlist',[
            'user'=>$user,
            'watchlists'=>$watchlists
        ]);
    }
//------------------------------------------------------------------------------\\


  
}
