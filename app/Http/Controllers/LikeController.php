<?php

namespace App\Http\Controllers;
use App\Like;
use App\Comment;
use Auth;
use Illuminate\Http\Request;

class LikeController extends Controller
{
//-------------------LIKE---------------------\\
    public function store(Comment $comment) 
    {
        //call method from Like model 
        //to like comment and return
        $comment->like();
        return back();
    }
//--------------------------------------------\\

//------------------DISLIKE-------------------\\
    public function destroy(Comment $comment) 
    {
        //call method from Like model 
        //to dislike comment and return
        $comment->dislike();
        return back();
    }
//--------------------------------------------\\

}
