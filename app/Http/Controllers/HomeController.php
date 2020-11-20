<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Movie;
use App\Cast;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $randomMovies = Movie::inRandomOrder()->take(9)->get();
        $popularMovies = Movie::inRandomOrder()->take(9)->get();
        $featuredCelebrities = Cast::withCount('favoritecast')->orderBy('favoritecast_count', 'desc')->take(4)->get();
        $topRatedMovies = Movie::where('imdb', '>=', 9)->take(9)->get();
        $mostWatchedMovies = Movie::inRandomOrder()->take(9)->get();
        $latestDramaMovies = Movie::where('genre', 'LIKE', 'Drama')->latest()->take(9)->get();
        $latestComedyMovies = Movie::where('genre', 'LIKE', 'Comedy')->latest()->take(9)->get();
        $latestActionMovies = Movie::where('genre', 'LIKE', 'Action')->latest()->take(9)->get();
        $latestHorrorMovies = Movie::where('genre', 'LIKE', 'Horror')->latest()->take(9)->get();
        $trailerMovies = Movie::all()->take(6);
        return view('home', [
            'popularMovies' => $popularMovies,
            'randomMovies' => $randomMovies,
            'featuredCelebrities' => $featuredCelebrities,
            'topRatedMovies' => $topRatedMovies,
            'mostWatchedMovies' => $mostWatchedMovies,
            'latestDramaMovies' => $latestDramaMovies,
            'latestActionMovies' => $latestActionMovies,
            'latestComedyMovies' => $latestComedyMovies,
            'latestHorrorMovies' => $latestHorrorMovies,
            'trailerMovies' => $trailerMovies
        ]);
    }
}
