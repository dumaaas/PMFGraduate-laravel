@extends('userLayout')
@section('profile')

    @auth
        @if ($user->privacy == 'private' && !Auth::user()->isFollowing($user) && !Auth::user()->currentUser($user))
            <div class="col-md-9 col-sm-12 col-xs-12">
                <div class="form-style-1 user-pro">
                    <h4><i class="fa fa-lock"> </i>&nbsp This account is private. </h4>
                    <h4>Follow user if you want to see more.</h4>
                </div>
            </div>

        @else

            <div class="col-md-9 col-sm-12 col-xs-12">
                <div class="form-style-1 user-pro">

                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-style-1 user-pro" action="">
                                <h4>
                                    <center><a><i class="fa fa-clock-o"> </i> MovieTime:</a>
                                        <br><br><br><label>{{ $movieTime }}</label> </center>
                                </h4>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-style-1 user-pro" action="">
                                <h4>
                                    <center>

                                        <a href="/users/{{ $user->id }}/watched"> <i class="fa fa-film"> </i>

                                            Movies Watched:
                                            <br><br><br><label>{{ $moviesNum }} movies</label></center>
                                </h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-style-1 user-pro" action="">
                                <h4>
                                    <center>

                                        <a href="/users/{{ $user->id }}/following"><i class="fa fa-user-plus"> </i>
                                            Following:</a <br><br><br><br><label>{{ $followingNum }}</label> </center>
                                </h4>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-style-1 user-pro" action="">
                                <h4>
                                    <center>

                                        <a href="/users/{{ $user->id }}/followers"><i class="fa fa-user-plus"> </i>

                                            Followers:
                                            <br><br><br><label>{{ $followersNum }}</label></a></center>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class=" cont 1 col-md-3 col-sm-3 col-xs-3">
                                <h4>Full name:</h4>
                                <p>{{ $user->firstName }} {{ $user->lastName }}</p>
                        </div>
                        <div class=" cont 1 col-md-3 col-sm-3 col-xs-3">
                                <h4>Country:</h4>
                                <p>{{ $user->country }}</p>
                        </div>
                        <div class=" cont 1 col-md-3 col-sm-3 col-xs-3">
                            <h4>City:</h4>
                            <p>{{ $user->city }}</p>
                        </div>
                        <div class=" cont 1 col-md-3 col-sm-3 col-xs-3">
                            <h4>Email:</h4>
                            <p>{{ $user->email }}</p>
                        </div>
                    </div>
               
                    <br><br><br><br>
                    <div class="row">
                        <div class=" cont1 col-md-12 col-sm-12 col-xs-12">
                            <div class=" title-hd-sm">
                                <h4>About <i class="ion-ios-arrow-right"></i></h4>

                            </div>
                            <p>{{ $user->description }}</p>
                        </div>
                    </div>



                </div>
            </div>
        @endif
    @endauth
    @guest
        @if ($user->privacy == 'private')
            <div class="col-md-9 col-sm-12 col-xs-12">
                <div class="form-style-1 user-pro">
                    <h4><i class="fa fa-lock"></i>&nbsp This account is private.</h4>
                    <h4> <a href="/register">Create account</a> and follow this user if you want to see more!</h4>
                </div>
            </div>

        @else

            <div class="col-md-9 col-sm-12 col-xs-12">
                <div class="form-style-1 user-pro">

                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-style-1 user-pro" action="">
                                <h4>
                                    <center><a><i class="fa fa-clock-o"> </i> MovieTime:</a>
                                        <br><br><br><label>{{ $movieTime }}</label> </center>
                                </h4>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-style-1 user-pro" action="">
                                <h4>
                                    <center>

                                        <a href="#"> <i class="fa fa-film"> </i>

                                            Movies Watched:
                                            <br><br><br><label>{{ $moviesNum }} movies</label></center>
                                </h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-style-1 user-pro" action="">
                                <h4>
                                    <center>

                                        <a href="#"><i class="fa fa-user-plus"> </i>

                                            Following:</a <br><br><br><br><label>{{ $followingNum }}</label> </center>
                                </h4>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="form-style-1 user-pro" action="">
                                <h4>
                                    <center>

                                        <a href="#"><i class="fa fa-user-plus"> </i>
                                            Followers:
                                            <br><br><br><label>{{ $followersNum }}</label></a></center>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class=" cont1 col-md-12 col-sm-12 col-xs-12">
                            <div class=" title-hd-sm">
                                <h4>About <i class="ion-ios-arrow-right"></i></h4>
                            </div>
                            <p>{{ $user->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endguest
@endsection
