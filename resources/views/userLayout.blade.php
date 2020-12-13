@extends('layout')

@section('userProfile')
    <div class="hero user-hero">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="hero-ct">
                        <h1>{{ $user->username }} profile page</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-single">
        <div class="container">
            <div class="row ipad-width">
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="user-information">
                        @include('flash::message')
                        <div class="user-img">
                            <a href="#">
                                <img src="/images/users/{{ $user->avatar }}" alt="" style="border-radius: 50%" width="200px">
                                <br>
                            </a>
                            @auth
                                @if (Auth::user()->is($user))
                                    <form action="/uploadImage/{{ $user->id }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="avatar" id="file-2" class="inputfile inputfile-2"
                                            data-multiple-caption="{count} files selected" multiple />
                                        <label for="file-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17"
                                                viewBox="0 0 20 17">
                                                <path
                                                    d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z" />
                                            </svg> <span>Choose file&hellip;</span></label>
                                        <br /><br /><input type="submit" class="redbtn" value="Change avatar">
                                    </form>
                                @else
                                    @if (Auth::user()->isFollowing($user))
                                        <a href="/unfollowUser/{{ $user->id }}" class="redbtn">Unfollow</a>
                                    @else
                                        @if ($user->isFollowing(Auth::user()))
                                            <a href="/followUser/{{ $user->id }}" class="redbtn">Follow back</a>
                                        @else
                                            <a href="/followUser/{{ $user->id }}" class="redbtn">Follow</a>
                                        @endif
                                    @endif
                                @endif
                            @endauth
                            <br>
                        </div>
                        <div class="user-fav">
                            <p>Account Details</p>
                            <ul>
                                <li class="active"><a href="/users/{{ $user->id }}">Profile</a></li>
                                @auth
                                    @if ($user->privacy == 'private' && !Auth::user()->isFollowing($user) && !Auth::user()->currentUser($user))
                                    @else
                                        <li><a href="/users/{{ $user->id }}/following">Following</a></li>
                                        <li><a href="/users/{{ $user->id }}/followers">Followers</a></li>
                                        <li><a href="{{route('movielist.index', ['user' => $user->id, 'type' => 'watched'])}}">Watched movies</a></li>
                                        <li><a href="{{route('movielist.index', ['user' => $user->id, 'type' => 'favorite'])}}">Favorite movies</a></li>
                                        <li><a href="{{route('movielist.index', ['user' => $user->id, 'type' => 'watchlist'])}}">Watchlist</a></li>
                                        <li><a href="{{route('movielist.index', ['user' => $user->id, 'type' => 'custom'])}}">Custom movies</a></li>
                                        <li><a href="/users/{{ $user->id }}/favoriteCast">Favorite celebrities</a></li>
                                        @can('edit', $user)
                                            <li><a href="/users/{{ $user->id }}/edit">Edit profile</a></li>
                                        @endcan
                                    @endif
                                @endauth
                            </ul>
                        </div>
                        @auth
                            <div class="user-fav">
                                <p>Others</p>
                                <ul>
                                    <li>
                                        <a href="/logout">
                                            Log out
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endauth
                    </div>
                </div>

                @yield('profile')
                @yield('editProfile')
                @yield('favoriteCastList')
                @yield('followers')
                @yield('following')
                @yield('movieList')
                @yield('name')
                @yield('notifications')

            </div>
        </div>
    </div>

@endsection
