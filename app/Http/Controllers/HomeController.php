<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
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
        $randomMovies = Cache::remember('randomMovies', Carbon::now()->addDay(), function() {
            return Movie::inRandomOrder()->take(9)->get();
        });
        $popularMovies = Cache::remember('popularMovies', Carbon::now()->addDay(), function() {
            return Movie::inRandomOrder()->take(9)->get();
        });
        $featuredCelebrities = Cache::remember('featuredCelebrities', Carbon::now()->addDay(), function() {
            return Cast::latest()->take(4)->get();
        });
        $topRatedMovies = Cache::remember('topRatedMovies', Carbon::now()->addDay(), function() {
            return Movie::where('imdb', '>=', 9)->take(9)->get();
        });
        $mostWatchedMovies = Cache::remember('mostWatchedMovies', Carbon::now()->addDay(), function() {
            return Movie::inRandomOrder()->take(9)->get();
        });
        $latestDramaMovies = Cache::remember('latestDramaMovis', Carbon::now()->addDay(), function() {
            return Movie::where('genre', 'LIKE', 'Drama')->latest()->take(9)->get();
        });
        $latestComedyMovies = Cache::remember('latestComedyMovies', Carbon::now()->addDay(), function() {
            return Movie::where('genre', 'LIKE', 'Comedy')->latest()->take(9)->get();
        });
        $latestActionMovies = Cache::remember('latestActionMovies', Carbon::now()->addDay(), function() {
            return Movie::where('genre', 'LIKE', 'Action')->latest()->take(9)->get();
        });
        $latestHorrorMovies = Cache::remember('latestHorrorMovies', Carbon::now()->addDay(), function() {
            return Movie::where('genre', 'LIKE', 'Horror')->latest()->take(9)->get();
        });
        $trailerMovies = Cache::remember('trailerMovies', Carbon::now()->addDay(), function() {
            return Movie::all()->take(6);
        });

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
