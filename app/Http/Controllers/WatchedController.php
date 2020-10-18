<?php

namespace App\Http\Controllers;

use App\Watched;
use Illuminate\Http\Request;
use App\User;
use Auth;


class WatchedController extends Controller
{
//--------------------------SHOW WATCHED LIST------------------------------\\
    public function index(User $user)
    {
        //authorize who can see user custom list
        $this->authorize('checkFollow', $user);

        //find user watched list
        $watcheds = Watched::where('user_id', '=', $user->id)->paginate(10);
        
        //return watched view page with details
        return view('users.watched',[
            'user' => $user,
            'watcheds'=>$watcheds
        ]);
    }
//--------------------------------------------------------------------------\\
}
