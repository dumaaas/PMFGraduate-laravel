<?php

namespace App\Http\Controllers;

use App\Cast;
use App\User;
use App\Movie;
use App\Watched;
use Illuminate\Http\Request;
use Auth;

class SearchController extends Controller
{
//---------------------------SEARCH CAST AND MOVIE BY FILTER--------------------------------\\
   
    public function searchCast(Request $request) {

        $casts = Cast::query();
        
        if($request->input('country')) {
            $country = $request->input('country');
            $casts = $casts->where('country', 'LIKE', $country);
        }
        if($request->input('letter')) {
            $letter = $request->input('letter');
            $casts = $casts->where('firstName', 'LIKE', $letter.'%');
        }
        if($request->input('category')) {
            $occupation = $request->input('category');
            $casts = $casts->where('occupation', 'LIKE', $occupation);
        }
        if($request->input('keyword')) {
            $keyword = $request->input('keyword');
            $casts = $casts->where('firstName','LIKE', '%'.$keyword.'%');
        }
        
        $castNum = $casts->count();
        $mostFeatured = Cast::withCount('favoritecast')
                            ->orderBy('favoritecast_count', 'desc'
                            )->take(4)
                            ->get();

        return view('cast.index',[
            'casts'=>$casts->get(),
            'castNum'=>$castNum,
            'mostFeatured'=>$mostFeatured,
        ]);
    }

    public function searchMovies(Request $request) {

        $movies = Movie::query();
        
        if($request->input('keyword')) {
            $keyword = $request->input('keyword');
            $movies = $movies->where('name','LIKE', '%'.$keyword.'%');
        }
        if($request->input('genre')) {
            $genre = $request->input('genre');
            $movies = $movies->where('genre', 'LIKE', $genre);
        }
        if($request->input('from') && $request->input('to')) {
            $from = $request->input('from');
            $to = $request->input('to');
            $movies = $movies->where('imdb', '>=', $from)->where('imdb', '<=', $to);
        }
        if($request->input('year')) {
            $year = $request->input('year');
            $movies = $movies->where('releaseYear', 'LIKE', $year);
            
        }
        return $this->movieViewDetails($movies->get());
    }
//------------------------------------------------------------------------------------------\\

//-----------------------------SEARCH CAST, MOVIES AND USERS--------------------------------\\
    public function search(Request $request) {
        $searchOptions = $_GET['searchOptions'];

        $search = $_GET['search'];
        if($searchOptions=='celebrities') {
            
            $castLastName = Cast::where('lastName', 'LIKE', '%'.$search.'%');
            $casts = Cast::where('firstName', 'LIKE', '%'.$search.'%')
                    ->union($castLastName)
                    ->latest()
                    ->get();
    
            $castNum = $casts->count();

            $mostFeatured = Cast::withCount('favoritecast')->orderBy('favoritecast_count', 'desc')->take(4)->get();
            return view('cast.index', [
                'casts'=>$casts,
                'castNum'=>$castNum,
                'mostFeatured'=>$mostFeatured
            ]);

        } elseif($searchOptions=='movies') {

                $releaseYear = Movie::where('releaseYear', 'LIKE', '%'.$search.'%');
                $movies = Movie::where('name', 'LIKE', '%'.$search.'%')
                        ->union($releaseYear)
                        ->get();

                return $this->movieViewDetails($movies);

        } elseif($searchOptions=='users') {

                $firstName = User::where('firstName', 'LIKE', '%'.$search.'%');
                $lastName = User::where('lastName', 'LIKE', '%'.$search.'%');
                $users = User::where('username', 'LIKE', '%' .$search.'%')
                        ->union($firstName)
                        ->union($lastName)
                        ->get();
                $usersNum = User::all()->count();
                $mostActive = User::withCount('watched')->orderBy('watched_count', 'desc')->take(4)->get();
                return view('users.index',[
                    'users'=>$users,
                    'usersNum'=>$usersNum,
                    'mostActive'=>$mostActive
                 ]);
        }
    }
//------------------------------------------------------------------------------------------\\

}
