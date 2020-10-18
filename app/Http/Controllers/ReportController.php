<?php

namespace App\Http\Controllers;

use PDF; 
use App\Movie;
use Illuminate\Http\Request;

class ReportController extends Controller
{
//---------------------------DOWNLOAD PDF REPORT---------------------------------\\
    public function report() {
        //get all movies for report
        $movies = Movie::all();
    
        //count total ratings sum and find movie with most ratings
        $ratingsNum=0; 
        $movieRating = Movie::all()->first();
        foreach($movies as $movie) {
            $ratingsNum=$ratingsNum+$movie->rating->count();
            if($movie->rating > $movieRating->rating) {
                $movieRating=$movie;
            }
        }

        //count total comments sum
        $commentsNum=0;
        foreach($movies as $movie) {
            $commentsNum=$commentsNum+$movie->comment->count();
        }

        //count total favorites sum 
        $favoritesNum=0;
        foreach($movies as $movie) {
            $favoritesNum=$favoritesNum+$movie->favorite->count();
        }

        //count total watched sum
        $watchedNum=0;
        foreach($movies as $movie) {
            $watchedNum=$watchedNum+$movie->watched->count();
        }

        //count total watchlist sum
        $watchlistNum=0;
        foreach($movies as $movie) {
            $watchlistNum=$watchlistNum+$movie->watchlist->count();
        }

        //count total custom sum
        $customNum=0;
        foreach($movies as $movie) {
            $customNum=$customNum+$movie->custom->count();
        }

        //load view from admin.pdf view where is html code that will be converted in pdf, with details
        $pdf = PDF::loadView('admin.pdf', [
            'movies'=>$movies, 
            'ratingsNum'=>$ratingsNum, 
            'commentsNum'=>$commentsNum, 
            'favoritesNum' => $favoritesNum,
            'watchedNum' => $watchedNum,
            'customNum' => $customNum, 
            'watchlistNum' => $watchlistNum,
            'movieRating' => $movieRating
            ]);
        
        //set paper format of pdf report
        $pdf->setPaper('a4', 'landscape');

        //return download link
        return $pdf->download();
    }
//-------------------------------------------------------------------------------\\

}
