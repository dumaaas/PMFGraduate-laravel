<?php

namespace App\Policies;

use App\User;
use Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

//class for user policies, which users have access to certain pages
class UserPolicy
{
  use HandlesAuthorization;


  //this function is executing before others, so if user is admin he can access all pages
  public function before(User $user) {
    if($user->isAdmin()) {
      return true;
    }
  }

  //only current user can access to editProfile
  public function edit(User $currentUser, User $user) {
    return $currentUser->is($user);
  }

  //only currentUser can upload image
  public function uploadImage(User $currentUser, User $user) {
      return $currentUser->is($user);
  }

  //check if user is following user, so we can know what details to show to that user
  public function checkFollow(User $currentUser, User $user) {
    return ($currentUser->isFollowing($user) || $currentUser->is($user));
  }

  //find out if current user is admin
  public function isAdmin(User $currentUser) {
    return $currentUser->isAdmin();
  }


}
