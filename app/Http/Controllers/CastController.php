<?php

namespace App\Http\Controllers;

use App\Cast;
use App\Acting;
use App\Likeable;
use App\User;
use App\Movie;
use Auth;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;


class CastController extends Controller
{

//------------------------------SHOW ALL CAST--------------------------------------\\
    public function index()
    {
        //get all cast ordered by latest added, count them and get 4 most favorited cast
        $casts = Cast::latest()->get();
        $castNum = Cast::all()->count();
        $mostFeatured = Cast::latest()->take(4)->get();

        //return cast index view with details
        return view('cast.index',[
            'casts'=>$casts,
            'castNum'=>$castNum,
            'mostFeatured'=>$mostFeatured,
        ]);
    }
//----------------------------------------------------------------------------------\\

    public function showFavoriteCast($id) {
        $user = User::find($id);
        //authorize who can see user favorite cast list
        $this->authorize('checkFollow', $user);

        //find user favorite cast list
        $favorites = Likeable::where('user_id', '=', $user->id)->where('likeable_type', Cast::class)->where('liked', 'LIKE', 'up')->paginate(10);
        //return favorite cast view page with details
        return view('users.favoritecast',[
            'user'=>$user,
            'favorites'=>$favorites
        ]);
    }

//--------------------------------SHOW CAST-----------------------------------------\\
    public function show(Cast $cast)
    {
        return $this->showCast($cast);
    }
//----------------------------------------------------------------------------------\\

//---------------------------------SORT CAST----------------------------------------\\
    public function sortCast(Request $request)
    {
        //get value of sort
        if(isset($_GET['sort'])) {
            $sort = $_GET['sort'];
        } else {
            $sort = '';
        }

        //sort cast from sort value
        switch ($sort) {
            case 'a-z':
                $casts = Cast::orderBy('firstName')->get();
                break;
            case 'z-a':
                $casts = Cast::orderBy('firstName', 'desc')->get();
                break;
            case 'birthDate':
                $casts = Cast::orderBy('birthDate')->get();
                break;
            case 'birthDate1':
                $casts = Cast::orderBy('birthDate', 'desc')->get();
                break;
            case 'mostFavorite':
                $casts = Cast::latest()->take(4)->get();
                break;
            case 'leastFavorite':
                $casts = Cast::latest()->take(3)->get();
                break;
            case 'mostMovies':
                $casts = Cast::withCount('acting')->orderBy('acting_count', 'desc')->get();
                break;
            case 'leastMovies':
                $casts = Cast::withCount('acting')->orderBy('acting_count')->get();
                break;
            default:
                $casts = Cast::latest()->paginate(6);

        }

        //get cast sum and get 4 most favorited cast
        $castNum = $casts->count();
        $mostFeatured = Cast::latest()->take(4)->get();

        //return cast index view with details
        return view('cast.index', [
            'casts'=>$casts,
            'castNum'=>$castNum,
            'mostFeatured'=>$mostFeatured
        ]);
    }
//----------------------------------------------------------------------------------\\

}
