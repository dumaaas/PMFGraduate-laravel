<?php

namespace App\Http\Controllers;
use App\Favoritecast;
use Auth;
use App\User;
use App\Cast;
use Illuminate\Http\Request;

class FavoritecastController extends Controller
{
//------------------------------SHOW FAVORITE CAST----------------------------------\\
    public function index(User $user) 
    {
        //authorize who can see user favorite cast list
        $this->authorize('checkFollow', $user);

        //find user favorite cast list
        $favorites = Favoritecast::where('user_id', '=', $user->id)->paginate(10);

        //return favorite cast view page with details
        return view('users.favoritecast',[
            'user'=>$user,
            'favorites'=>$favorites
        ]);
    }
//----------------------------------------------------------------------------------\\

//-----------------------------ADD FAVORITE CAST------------------------------------\\

    public function favoriteStore(Request $request, Cast $cast)
    {
        //add new favorite cast and save it
        $favorite = new Favoritecast();

        $favorite->user_id=Auth::user()->id;
        $favorite->cast_id=$cast->id;

        $favorite->save();

        //flash success message if user added cast in favorite list
        flash('Celebrity added to favorites!')->success();

        //return back to the cast show page
        return back();
    }
//----------------------------------------------------------------------------------\\

//----------------------------DELETE FAVORITE CAST----------------------------------\\

    public function favoriteDestroy(Cast $cast)
    {
        //delete cast from favorite cast list
        $favorite = Favoritecast::where('user_id', '=', Auth::user()->id)->where('cast_id', '=', $cast->id)->delete();

        //flash success message if user deleted cast from favorite list
        flash('Celebrity removed from favorites!')->success();
        
        //return back to the cast show page
        return back();
    }
//----------------------------------------------------------------------------------\\

}
