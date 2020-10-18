<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Favorite;
use App\Custom;
use App\Watchlist;
use App\Acting;
use App\Cast;
use App\Watched;
use App\Comment;
use App\User;
use App\Rating;
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
        //get all movies ordered by latest added and return movie index
        $movies = Movie::latest()->get();
        return $this->movieViewDetails($movies);       
    }
//---------------------------------------------------------------------------------\\

//---------------------------------SHOW MOVIE--------------------------------------\\
    public function show(Movie $movie)
    {
        //find all ratings for current movie, count ratings and find average rating
        $ratings = Rating::where('movie_id', 'LIKE', $movie->id)->get();
        $ratingNum = (int) $ratings->count();
        $ratingSum=0;
        foreach($ratings as $rating) {
            $ratingSum=$ratingSum+(int) $rating->rating;
        }
        
        if($ratingNum==0) {
            $rating = 0;
        } else {
            $rating = round($ratingSum/$ratingNum);
        }
        
        //find all details which are needed to show on movie show page
        $actings = Acting::where('movie_id', '=', $movie->id)->get();
        $stars = Acting::where('movie_id', '=', $movie->id)->latest()->take(3)->get();
        $director = Cast::where('occupation', '=', 'director')->first();
        $sumWatched = Watched::where('movie_id', '=', $movie->id)->count();
        $comments = Comment::where('movie_id', '=', $movie->id)->withLikes()->latest()->paginate(5);
        $sumComments = Comment::where('movie_id', '=', $movie->id)->count();

        //return movie show page with 
        return view('movies.show',[
            'movie'=>$movie,
            'actings'=>$actings,
            'director'=>$director,
            'sumWatched'=>$sumWatched,
            'comments'=>$comments,
            'stars'=>$stars,
            'sumComments'=>$sumComments,
            'rating' => $rating,
            'ratingNum' => $ratingNum,
            'ratings' => $ratings
        ]);
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
            'descrption'=>'required',
        ]);

        $movie->name=$name;
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
    public function sortMovies(Request $request) 
    {
        //get value of sort
        if(isset($_GET['sort'])) {
            $sort = $_GET['sort'];
        } else {
            $sort = '';
        }
        
        //sort users from sort value
        switch ($sort) {
            case 'ratingHighest':
                $movies = Movie::orderBy('imdb', 'desc')->get();
                break;
            case 'ratingLowest':
                $movies = Movie::orderBy('imdb')->get();
                break;
            case 'newest':
                $movies = Movie::orderBy('created_at', 'desc')->get();
                break;
            case 'oldest': 
                $movies = Movie::orderBy('created_at')->get();
                break;
            case 'favoriteMost':
                $movies = Movie::withCount('favorite')->orderBy('favorite_count', 'desc')->get();
                break;
            case 'favoriteLeast': 
                $movies = Movie::withCount('favorite')->orderBy('favorite_count')->get();
                break;
            case 'watchedMost': 
                $movies = Movie::withCount('watched')->orderBy('watched_count', 'desc')->get();
                break;
            case 'watchedLeast': 
                $movies = Movie::withCount('watched')->orderBy('watched_count')->get();
                break;
            case 'commentsMost': 
                $movies = Movie::withCount('comment')->orderBy('comment_count', 'desc')->get();
                break;
            case 'commentsLeast': 
                $movies = Movie::withCount('comment')->orderBy('comment_count')->get();
                break;
            case 'watched':
                break;
            default: 
                $movies = Movie::latest()->get();

        }
        
        //return to the movie index with sorted movies
        return $this->movieViewDetails($movies);       
    }
//----------------------------------------------------------------------------------\\

//-----------------------STORE AND DELETE FROM WISHED LIST--------------------------\\
    public function storeListItem(Request $request, $addToList, Movie $movie) 
    {
        //request route to know which operation is asked for
        $route = $request->path();

        //add movie to the wished list and flash message 
        switch ($route) {
            case 'addFavorite/'.$movie->id:
                $favorite = Favorite::create(['user_id' => Auth::user()->id, 'movie_id' => $movie->id]);
                flash('Movie added to favorites!')->success();
                break;
            case 'addCustom/'.$movie->id:
                $custom = Custom::create(['user_id' => Auth::user()->id, 'movie_id' => $movie->id]);
                flash('Movie added to custom!')->success();
                break;
            case 'addWatchlist/'.$movie->id:
                $watchlist = Watchlist::create(['user_id' => Auth::user()->id, 'movie_id' => $movie->id]);
                flash('Movie added to watchlist!')->success();
                break;
            case 'addWatched/'.$movie->id: 
                $watched = Watched::create(['user_id' => Auth::user()->id, 'movie_id' => $movie->id]);
                
                //if movie is marked as watched, then movie will be deleted from watchlist
                $watchlist = Watchlist::where('user_id', '=', Auth::user()->id)->where('movie_id', '=', $movie->id);

                if($watchlist!=null) {
                    $watchlist->delete();
                }

                flash('Movie added to watched!')->success();
                break;
        }
        
        //return to the movie page
        return back();
    }

    public function destroyFromList(Request $request, $destroyFromList, Movie $movie) 
    {
        //request route to know which operation is asked for
        $route = $request->path();

        //delete movie from the wished list and flash message 
        switch ($route) {
            case 'favoriteDestroy/'.$movie->id:
                $favorite = Favorite::where('user_id', '=', Auth::user()->id)->where('movie_id', '=', $movie->id)->delete();
                flash('Movie removed from favorites!')->success();
                break;
            case 'customDestroy/'.$movie->id:
                $custom = Custom::where('user_id', '=', Auth::user()->id)->where('movie_id', '=', $movie->id)->delete();
                flash('Movie removed from custom!')->success();
                break;
            case 'watchlistDestroy/'.$movie->id:
                $watchlist = Watchlist::where('user_id', '=', Auth::user()->id)->where('movie_id', '=', $movie->id)->delete();
                flash('Movie removed from watchlist!')->success();
                break;
            case 'watchedDestroy/'.$movie->id: 
                $watched = Watched::where('user_id', '=', Auth::user()->id)->where('movie_id', '=', $movie->id)->delete();
                flash('Movie removed from watched!')->success();
                break;
        }
        
        //return to the movie page
        return back();
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
