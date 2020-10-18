<?php

namespace App\Http\Controllers;

use App\Custom;
use App\User;
use Auth;
use Illuminate\Http\Request;

class CustomController extends Controller
{
//-------------------------SHOW CUSTOM LIST-------------------------------\\
    public function index(User $user)
    {
        //authorize who can see user custom list
        $this->authorize('checkFollow', $user);
        
        //find user custom list
        $customs = Custom::where('user_id', '=', $user->id)->paginate(10);
        
        //return custom view page with details
        return view('users.custom',[
            'user'=>$user,
            'customs'=>$customs
        ]);
    }
//------------------------------------------------------------------------\\

}
