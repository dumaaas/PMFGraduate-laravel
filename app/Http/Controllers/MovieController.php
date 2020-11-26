<?php

namespace App\Http\Controllers;

use App\MovieList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Movie;
use App\Acting;
use App\Cast;
use App\Comment;
use App\User;
use App\Rating;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewMovie;
use Auth;
use Http;

class MovieController extends Controller
{

//-----------------------------SHOW ALL MOVIES-------------------------------------\\
    public function index()
    {
        $moviesTotal = Cache::remember('moviesTotal', Carbon::now()->addMinutes(10), function () {
            return Movie::all()->count();
        });
        $watchedCount = Cache::remember('watchedCount', Carbon::now()->addMinutes(10), function () {
            return MovieList::where('user_id', 'LIKE', Auth::user()->id)->where('type', 'LIKE', 'watched')->count();
        });

        if($watchedCount!=0) {
            $percent = number_format(($watchedCount/$moviesTotal)*100,2);
        } else {
            $percent = 0;
        }
        return view('movies.index', [
            'moviesTotal' => $moviesTotal,
            'watchedCount' => $watchedCount,
            'percent' => $percent
        ]);
    }
//---------------------------------------------------------------------------------\\

public function getMovies() {
    //get all movies ordered by latest added and return movie index
    $movies = Cache::remember('movies', Carbon::now()->addMinutes(10), function() {
        return Movie::latest()->get();
    });
    return $movies;
}

//---------------------------------SHOW MOVIE--------------------------------------\\
    public function show(Movie $movie)
    {
       return $this->showMovie($movie);
    }
//----------------------------------------------------------------------------------\\

//----------------------------CREATE NEW MOVIE--------------------------------------\\
    public function create()
    {
        //authorize so only admin can see add new movie button
        $this->authorize('isAdmin', Auth::user());

        //get all actors
        $actors = Cast::all();

        //return to view that show form for adding new movie
        return view ('admin.newMovie',[
            'actors'=>$actors
        ]);
    }

    public function store(Request $request)
    {
        //authorize so only admin can add new movie
        $this->authorize('isAdmin', Auth::user());

        //request all data, validate and save movie
        request()->validate([
            'name'=>'required',
            'genre'=>'required',
            'releaseYear' => 'required',
            'imdb'=>'required',
            'duration'=>'required',
            'trailer'=>'required',
            'description'=>'required',
            'actors'=>'required'
        ]);

        $movie = new Movie();

        $movie->name=request('name');
        $movie->genre=request('genre');
        $movie->releaseYear=request('releaseYear');
        $movie->imdb=request('imdb');
        $movie->duration=request('duration');
        $movie->trailer=request('trailer');
        $movie->description=request('description');
        $avatar = $request->file('avatar');
        $actors = $request->input('actors');

        if($avatar == null) {
            $filename = 'default' . '.' .'jpg';
            $movie->avatar = $filename;
        } else {
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(340,521)->save(public_path('/images/movies/' . $filename));
            $movie->avatar = $filename;
        }

        $movie->save();

        //get all users to notify them about adding new movie
        $users=User::all();

        foreach($users as $u) {
            $u->notify(new NewMovie($movie));
        }

        //save every choosed actor in Acting table
        foreach($actors as $id) {
            $acting = new Acting();
            $acting->movie_id=$movie->id;
            $acting->cast_id=$id;
            $acting->save();
        }

        //return to the add new movie page
        return back();
    }
//----------------------------------------------------------------------------------\\

//----------------------------EDIT EXISTING MOVIE-----------------------------------\\
    public function edit(Movie $movie)
    {
        //show view for editing movie form
        return view('admin.editMovie', [
            'movie'=>$movie
        ]);
    }

    public function update(Request $request, Movie $movie)
    {
        //request all data, validate and update movie
        request()->validate([
            'name'=>'required',
            'genre'=>'required',
            'releaseYear' => 'required',
            'imdb'=>'required',
            'duration'=>'required',
            'trailer'=>'required',
            'description'=>'required',
        ]);

        $movie->name=request('name');
        $movie->genre=request('genre');
        $movie->releaseYear=request('releaseYear');
        $movie->imdb=request('imdb');
        $movie->duration=request('duration');
        $movie->trailer=request('trailer');
        $movie->description=request('description');
        $avatar = $request->file('avatar');

        if(!empty($avatar)) {
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->save(public_path('/images/movies/' . $filename));
            $movie->avatar = $filename;
        }

        $movie->save();

        //return back to the edit movie form
        return back();
    }
//----------------------------------------------------------------------------------\\

//--------------------------------SORT MOVIES---------------------------------------\\
    public function sortMovies(Request $request, $sort)
    {
        //get value of sort
        $sort = request('sort');

        //sort users from sort value
        switch ($sort) {
            case 'newest':
                $movies = Movie::orderBy('created_at', 'desc')->get();
                break;
            case 'oldest':
                $movies = Movie::orderBy('created_at')->get();
                break;
            default:
                $movies = Movie::latest()->get();

        }

        //return to the movie index with sorted movies
        return $movies;
    }
//----------------------------------------------------------------------------------\\

//-----------------------STORE AND DELETE FROM WISHED LIST--------------------------\\
    public function storeListItem(Request $request, $addToList, Movie $movie, $type)
    {
        //request route to know which operation is asked for
        $route = $request->path();

        //add movie to the wished list and flash message
        switch ($route) {
            case 'addFavorite/'.$movie->id.'/favorite':
                $favorite = MovieList::create(['user_id' => Auth::user()->id, 'movie_id' => $movie->id, 'type' => $type]);
                flash('Movie added to favorites!')->success();
                break;
            case 'addCustom/'.$movie->id.'/custom':
                $custom = MovieList::create(['user_id' => Auth::user()->id, 'movie_id' => $movie->id, 'type' => $type]);
                flash('Movie added to custom!')->success();
                break;
            case 'addWatchlist/'.$movie->id.'/watchlist':
                $watchlist = MovieList::create(['user_id' => Auth::user()->id, 'movie_id' => $movie->id, 'type' => $type]);
                flash('Movie added to watchlist!')->success();
                break;
            case 'addWatched/'.$movie->id.'/watched':
                $watched = MovieList::create(['user_id' => Auth::user()->id, 'movie_id' => $movie->id, 'type' => $type]);
                flash('Movie added to watched!')->success();
                break;
        }

        //return to the movie page
        return $this->showMovie($movie);
    }

    public function destroyFromList(Request $request, $destroyFromList, Movie $movie, $type)
    {
        //request route to know which operation is asked for
        $route = $request->path();

        //delete movie from the wished list and flash message
        switch ($route) {
            case 'favoriteDestroy/'.$movie->id.'/favorite':
                MovieList::where('user_id', '=', Auth::user()->id)->where('movie_id', '=', $movie->id)->where('type', '=', $type)->delete();
                flash('Movie removed from favorites!')->success();
                break;
            case 'customDestroy/'.$movie->id.'/custom':
                MovieList::where('user_id', '=', Auth::user()->id)->where('movie_id', '=', $movie->id)->where('type', '=', $type)->delete();
                flash('Movie removed from custom!')->success();
                break;
            case 'watchlistDestroy/'.$movie->id.'/watchlist':
                MovieList::where('user_id', '=', Auth::user()->id)->where('movie_id', '=', $movie->id)->where('type', '=', $type)->delete();
                flash('Movie removed from watchlist!')->success();
                break;
            case 'watchedDestroy/'.$movie->id.'/watched':
                MovieList::where('user_id', '=', Auth::user()->id)->where('movie_id', '=', $movie->id)->where('type', '=', $type)->delete();
                flash('Movie removed from watched!')->success();
                break;
        }

        //return to the movie page
        return $this->showMovie($movie);
    }
//----------------------------------------------------------------------------------\\

//---------------------------------DELETE MOVIE-------------------------------------\\
    public function destroy(Movie $movie)
    {
        Movie::destroy($movie->id);
        return back();
    }
//----------------------------------------------------------------------------------\\

}
