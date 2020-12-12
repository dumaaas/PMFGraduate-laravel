<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Notifications\NewComment;
use Illuminate\Http\Request;
use App\Movie;
use App\Favorite;
use App\Custom;
use App\Watchlist;
use App\User;
use App\Watched;
use Auth;

class CommentController extends Controller
{
    public function show(Comment $comment)
    {
        return $comment->replies()->latest()->paginate(25);
    }

    public function getComments()
    {
        return Comment::latest()->get();
    }

//-----------------------------ADD NEW COMMENT--------------------------------------\\
    public function store(Request $request, Movie $movie)
    {

        $comment = auth()->user()->comment()->create([
            'content' => $request->content,
            'commentable_id' => $movie->id,
            'commentable_type' => "App\Movie",
            'comment_id' => $request->comment_id
        ])->fresh();

        $users = User::where('role', 'LIKE', 'admin')->get();
        foreach ($users as $u) {
            $u->notify(new NewComment($comment));
        }

        return $comment;
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
        return ['message' => 'Comment has been deleted!'];
    }
//----------------------------------------------------------------------------------\\


}
