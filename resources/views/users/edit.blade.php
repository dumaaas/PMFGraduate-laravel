@extends('userLayout')

@section('editProfile')
    <div class="col-md-9 col-sm-12 col-xs-12">
        <div class="form-style-1 user-pro" action="">
            <form action="/updateDetails/{{ $user->id }}" class="user" method="POST">
                @csrf
                <h4>Profile details</h4>
                <div class="row">
                    <div class="col-md-6 form-it">
                        <label>Username</label>
                        <input type="text" name="username" value="{{ $user->username }}">
                    </div>
                    <div class="col-md-6 form-it">
                        <label>Email Address</label>
                        <input type="text" value="{{ $user->email }}" name="email">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-it">
                        <label>First Name</label>
                        <input type="text" value="{{ $user->firstName }}" name="firstName">
                    </div>
                    <div class="col-md-6 form-it">
                        <label>Last Name</label>
                        <input type="text" value="{{ $user->lastName }}" name="lastName">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-it">
                        <label>Country</label>
                        <input type="text" value="{{ $user->country }}" name="country">
                    </div>
                    <div class="col-md-6 form-it">
                        <label>City</label>
                        <input type="text" value="{{ $user->city }}" name="city">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-it">
                        <label>Description</label>
                        <input type="text" value="{{ $user->description }}" name="description">
                    </div>
                    <div class="col-md-6 form-it">
                        <label>Phone number</label>
                        <input type="text" value="{{ $user->phoneNumber }}" name="phoneNumber">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <input class="submit" type="submit" value="save">
                    </div>
                </div>
            </form><br>
            <form action="/privateProfile/{{ $user->id}}" class="user" method="POST">
                @csrf
                <h4>Privacy</h4> 
                <div >
                    <input type="radio" name="privateOrPublic" value="public" checked>
                    <label >Public profile</label>
                  </div>
                  
                  <!-- Group of default radios - option 2 -->
                  <div class="custom-control custom-radio">
                    <input type="radio"  name="privateOrPublic" value="private">
                    <label>Private profile</label>
                  </div>
                  <div class="row">
                    <div class="col-md-2">
                        <input class="submit" type="submit" value="Save">
                    </div>
                </div>
            </form>
            <form action="/updatePassword/{{ $user->id }}" class="password" method="POST">
                @csrf
                <h4>Change password</h4>

                <div class="row">

                   
                    <div class="col-md-6 form-it">
                        <label>Old Password</label>
                        <input type="password" placeholder="**********""
                            name="oldPassword">
                            @error('oldPassword')
                            <small class="errors">{{$message}}</small>
                            @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-it">
                        <label>New Password</label>
                        <input type="password" placeholder="***************" name="newPassword">
                            @error('newPassword')
                            <small class="errors">{{ $message }}</small>
                            @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-it">
                        <label>Confirm New Password</label>
                        <input type="password" placeholder="*************** " name="confirmPassword">
                        @error('confirmPassword')
                            <small class="errors">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
               
                <div class="row">
                    <div class="col-md-2">
                        <input class="submit" type="submit" value="Change">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
