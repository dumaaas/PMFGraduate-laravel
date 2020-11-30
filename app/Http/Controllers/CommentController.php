<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Movie;
use App\Favorite;
use App\Custom;
use App\Watchlist;
use App\Acting;
use App\Cast;
use App\Watched;
use Auth;


class CommentController extends Controller
{
//-----------------------------ADD NEW COMMENT--------------------------------------\\
    public function store(Request $request, Movie $movie)
    {
        return auth()->user()->comment()->create([
            'content' => $request->content,
            'commentable_id' => $movie->id,
            'commentable_type' => "App\Movie"
        ])->fresh();
    }
//----------------------------------------------------------------------------------\\

    public function index(Movie $movie) {
        return $movie->comment()->latest()->paginate(10);
    }

//-----------------------------DELETE COMMENT---------------------------------------\\
    public function destroy($id)
    {
        //delete comment and return to the comment table in dashboard
        Comment::destroy($id);
        return back();
    }
//----------------------------------------------------------------------------------\\

}
