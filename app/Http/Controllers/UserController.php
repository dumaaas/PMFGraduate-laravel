<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Watched;
use App\Follow;
use Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Hash;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use App\Rules\MatchOldPassword;


class UserController extends Controller
{

//-------------------------------SHOWING USER PROFILE----------------------------------\\
    public function show(User $user)
    {
        //find movies that user watched, sum durations and count 
        $sum=0;
        $watchedMovies = Watched::where('user_id', 'LIKE', $user->id)->get();
        foreach($watchedMovies as $wm) {
            $sum = $sum + $wm->movie->duration;
        }
        $moviesNum = $watchedMovies->count();     
        $movieTime = CarbonInterval::minutes($sum)->cascade()->forHumans();

        //find number of followers and followings of user
        $followersNum = Follow::where('following_user_id', 'LIKE', $user->id)->count();
        $followingNum = Follow::where('user_id', 'LIKE', $user->id)->count();

        //return view that shows user profile
        return view('users.show',[
            'user'=>$user,
            'movieTime' => $movieTime,
            'moviesNum' => $moviesNum,
            'followersNum' => $followersNum,
            'followingNum' => $followingNum
        ]);
    }
//--------------------------------------------------------------------------------------\\

//-----------------------------EDITING PROFILE METHODS----------------------------------\\
    public function edit(User $user)
    {
        //authorize so only auth user can access to edit profile page
        $this->authorize('edit', $user);

        //return view that show editing profile form
        return view('users.edit', [
            'user'=>$user,
        ]);
    }

    public function uploadImage(Request $request, User $user) 
    {
        //authorize so only auth user can upload his profile photo
        $this->authorize('uploadImage', $user);

        //request data from input['file'], get extension, then resize image and save it to users folder on server
        $avatar = $request->file('avatar');
        $filename = time() . '.' . $avatar->getClientOriginalExtension();
        Image::make($avatar)->resize(300,300)->save(public_path('/images/users/' . $filename));
        $user->avatar = $filename;
        $user->save();

        //flash success message if user changed photo
        flash('Profile image changed!')->success();

        //return back to user profile page
        return back();
    }

    public function updatePassword(Request $request, User $user) 
    {
        //request all data from input and validate it 
        $request->validate([
            'oldPassword' => ['required', new MatchOldPassword],
            'newPassword' => ['required'],
            'confirmPassword' => ['same:newPassword'],
        ]);
            
        //if validation was successful, update password 
        $user->update(['password'=> Hash::make($request->newPassword)]);
        
        //flash success message if user changed photo
        flash('Password changed!')->success();

        //return back to the user editing form
        return back();
    }

    public function updateUserDetails(Request $request, User $user) 
    {
        //request data from inputs and validate it and update user details
        $request->validate([
            'firstName'=>'required',
            'lastName'=>'required',
            'username'=>'required',
            'email'=>'required',
        ]);

        $user->firstName=request('firstName');
        $user->lastName=request('lastName');
        $user->username=request('username');
        $user->email=request('email');
        $user->phoneNumber=request('phoneNumber');
        $user->country=request('country');
        $user->city=request('city');
        $user->description=request('description');

        $user->save();
       
        //flash success message if user updated profile
        flash('Profile updated!')->success();

        //return back to the user editing form
        return back();
    }

    public function privateProfile(Request $request, User $user) 
    {
        //request input value to check if user want to set profile on private or public
        $privacy = request('privateOrPublic');

        //update profile privacy 
        if($privacy == 'private'){
            $user->privacy = 'private';
        } else{
            $user->privacy = 'public';
        } 

        $user->save();

        //flash success message if user updated privacy
        flash('Profile privacy changed!')->success();
       
        //return back to the user editing form
        return back();
    }
//--------------------------------------------------------------------------------------\\

//----------------------------------SORTING USERS---------------------------------------\\
    public function sortUsers(Request $request) 
    {
        //get value of sort
        if(isset($_GET['sort'])) {
            $sort = $_GET['sort'];
        } else {
            $sort = '';
        }
        
        //sort users from sort value
        switch ($sort) {
            case 'a-z':
                $users = User::orderBy('firstName')->get();
                break;
            case 'z-a':
                $users = User::orderBy('firstName', 'desc')->get();
                break;
            case 'mostWatched':
                $users = User::withCount('watched')->orderBy('watched_count', 'desc')->get();
                break;
            case 'leastWatched': 
                $users = User::withCount('watched')->orderBy('watched_count')->get();
                break;
            case 'mostComments': 
                $users = User::withCount('comment')->orderBy('comment_count', 'desc')->get();
                break;
            case 'leastComments': 
                $users = User::withCount('comment')->orderBy('comment_count')->get();
                break;
            case 'mostRatings': 
                $users = User::withCount('rating')->orderBy('rating_count', 'desc')->get();
                break;
            case 'leastRatings': 
                $users = User::withCount('rating')->orderBy('rating_count')->get();
                break;
            default: 
                $users = User::latest()->get();

        }

        //return number of users and most active users to display them on index page
        $usersNum = $users->count();
        $mostActive = User::withCount('watched', 'rating', 'comment')->orderBy('watched_count', 'desc')->orderBy('rating_count', 'desc')->orderBy('comment_count', 'desc')->take(4)->get();
        
        //return view that show list of sorted users
        return view('users.index', [
            'users'=>$users,
            'usersNum'=>$usersNum,
            'mostActive'=>$mostActive
        ]);
    }
//--------------------------------------------------------------------------------------\\

//--------------------------------DELETING USER------------------------------------------\\
    public function destroy(User $user)
    {
        //delete user and return back to the userTable in dashboard
        User::destroy($user->id);
        return back();
    }

    public function ban(User $user) 
    {
        //ban user for 7 days and return to the userTable in dashboard
        $user->banned_until = Carbon::now()->addDays(7);
        $user->save();
        return back();
    }
//--------------------------------------------------------------------------------------\\ 
 
}
