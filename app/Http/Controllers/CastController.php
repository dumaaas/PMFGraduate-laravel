<?php

namespace App\Http\Controllers;

use App\Cast;
use App\Acting;
use App\User;
use App\Movie;
use App\Favoritecast;
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
        $mostFeatured = Cast::withCount('favoritecast')->orderBy('favoritecast_count', 'desc')->take(4)->get();
        
        //return cast index view with details
        return view('cast.index',[
            'casts'=>$casts,
            'castNum'=>$castNum,
            'mostFeatured'=>$mostFeatured,
        ]);
    }
//----------------------------------------------------------------------------------\\

//--------------------------------SHOW CAST-----------------------------------------\\
    public function show(Cast $cast)
    {
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
                $casts = Cast::withCount('favoritecast')->orderBy('favoritecast_count', 'desc')->get();
                break;
            case 'leastFavorite': 
                $casts = Cast::withCount('favoritecast')->orderBy('favoritecast_count')->get();
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
        $mostFeatured = Cast::withCount('favoritecast')->orderBy('favoritecast_count', 'desc')->take(4)->get();

        //return cast index view with details
        return view('cast.index', [
            'casts'=>$casts,
            'castNum'=>$castNum,
            'mostFeatured'=>$mostFeatured
        ]);
    }
//----------------------------------------------------------------------------------\\

}
