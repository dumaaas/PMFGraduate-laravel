<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Movie;
use App\Comment;
use App\Rating;
use Auth;

class AdminController extends Controller
{
//--------------------------SHOW DASHBOARD------------------------------\\
    public function showDashboard(Request $request)
    {
        //authorize so only admin can see dashboard
        $this->authorize('isAdmin', Auth::user());

        //get details needed in dashboard
        $movies = Movie::latest()->take(4)->get();
        $users = User::latest()->take(4)->get();
        $comments = Comment::latest()->take(4)->get();
        $ratings = Rating::latest()->take(4)->get();
        $moviesNum = Movie::all()->count();
        $usersNum = User::all()->count();
        $commentsNum = Comment::all()->count();
        $ratingsNum = Rating::all()->count();

        //return dashboard view with details
        return view('admin.dashboard',[
            'movies'=>$movies,
            'users'=>$users,
            'comments'=>$comments,
            'ratings'=>$ratings,
            'moviesNum'=>$moviesNum,
            'usersNum'=>$usersNum,
            'commentsNum'=>$commentsNum,
            'ratingsNum'=>$ratingsNum
        ]);
    }
//----------------------------------------------------------------------\\

//-----------------------SHOW DASHBOARD TABLES--------------------------\\
    public function showUserTable() 
    {
        //authorize so only admin can see user table
        $this->authorize('isAdmin', Auth::user());

        //get users for table with pagination
        $users = User::paginate(5);

        //return user table view with details
        return view('admin.userTable',[
            'users' => $users
        ]);
    }

    public function showMovieTable() 
    {
        //authorize so only admin can see movie table
        $this->authorize('isAdmin', Auth::user());

        //get movies for table with pagination
        $movies = Movie::paginate(5);

        //return movie table view with details
        return view('admin.movieTable',[
            'movies' => $movies
        ]);
    }

    public function showCommentTable() 
    {
        //authorize so only admin can see comment table
        $this->authorize('isAdmin', Auth::user());

        //get comments for table with pagination
        $comments = Comment::paginate(5);

        //return comments table view with details
        return view('admin.commentTable',[
            'comments' => $comments
        ]);
    }

    public function showRatingTable() 
    {
        //authorize so only admin can see rating table
        $this->authorize('isAdmin', Auth::user());

        //get comments for table with pagination
        $ratings = Rating::paginate(5);

        //return ratings table view with details
        return view('admin.ratingTable',[
            'ratings' => $ratings
        ]);
    }
//----------------------------------------------------------------------\\

}