<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Follow;
use Auth;
use App\Notifications\UserFollowed;


class FollowController extends Controller
{

//-------------------------FOLLOWERS AND FOLLOWING LISTS---------------------------\\
    public function followers(User $user) {
        //get list of followers for user
        $followers = Follow::where('following_user_id', 'LIKE', $user->id)->get();
       
        //return followers view with details
        return view('users.followers', [
            'user'=>User::find($user->id),
            'followers' => $followers
        ]);
    }

    public function following(User $user) {

        //get list of following for user
        $following = $user->follows()->get();

        //return following view with details
        return view('users.following',[
            'user'=>$user,
            'following' => $following,
        ]);
    }
//---------------------------------------------------------------------------------\\

//-----------------------------FOLLOW AND UNFOLLOW---------------------------------\\
    public function followUser(User $user) {
        //add new follow and save it
        $follow = new Follow();
        $follow->user_id=Auth::User()->id;
        $follow->following_user_id=$user->id;
        $follow->save();

        // sending a notification to user who has been followed
         $user->notify(new UserFollowed(Auth::user()));

        //flash success message if user succesully followed user
         flash('You followed '.$user->username. '!')->success();

        //return back to the user profile
        return back();
    }

    public function unfollowUser(User $user) {
        //unfollow user
        Auth::user()->unfollow($user->id);

        //flash success message if user succesully unfollowed user
        flash('You unfollowed '.$user->username. '!')->success();

        //return back to the user profile
        return back();
    }
//---------------------------------------------------------------------------------\\

}
