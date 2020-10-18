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
        //request all data, validate and add new comment
        request()->validate([
            'content'=>'required',
        ]);

        $comment = new Comment();
        $comment->content=request('content');
        $comment->user_id=Auth::user()->id;
        $comment->movie_id=$movie->id;

        $comment->save();

        //return back to the movie page;
        return back();
    }
//----------------------------------------------------------------------------------\\

//-----------------------------DELETE COMMENT---------------------------------------\\
    public function destroy($id)
    {
        //delete comment and return to the comment table in dashboard
        Comment::destroy($id);
        return back();
    }
//----------------------------------------------------------------------------------\\

}
