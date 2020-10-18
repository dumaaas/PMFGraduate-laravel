<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\User;
use Illuminate\Http\Request;
use Auth;

class FavoriteController extends Controller
{
//------------------------SHOW FAVORITE LIST-----------------------------\\
    public function index(User $user)
    {
        //authorize who can see user favorite list
        $this->authorize('checkFollow', $user);
        
        //find user favorite list
        $favorites = Favorite::where('user_id', '=', $user->id)->paginate(10);

        //return favorite view page with details
        return view('users.favorite',[
            'user'=>$user,
            'favorites'=>$favorites
        ]);
    }
//------------------------------------------------------------------------\\

}
