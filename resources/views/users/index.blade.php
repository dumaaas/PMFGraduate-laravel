@extends('layout')
@section('userList')
    <div class="hero common-hero">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="hero-ct">
                        <h1>User list</h1>
                        <ul class="breadcumb">
                            <li class="active"><a href="#">Home</a></li>
                            <li> <span class="ion-ios-arrow-right"></span> user listing</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- celebrity list section-->
    <div class="page-single">
        <div class="container">
            <div class="row ipad-width2">
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <form method="GET" action="/sortUsers">
                        @csrf
                        <div class="topbar-filter">
                            <p class="pad-change">Found <span>{{ $usersNum }} users</span> in total</p>
                            <label>Sort by:</label>

                            <select name="sort">
                                <option disabled selected value=""> -- select an option -- </option>
                                <option value="a-z">A-Z</option>
                                <option value="z-a">Z-A</option>
                                <option value="mostWatched">Most watched</option>
                                <option value="leastWatched">Least watched</option>
                                <option value="mostComments">Most comments</option>
                                <option value="leastComments">Least comments</option>
                                <option value="mostRatings">Most ratings</option>
                                <option value="leastRatings">Least ratings</option>
                            </select>


                            <button>SORT</button>

                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-12">
                            @foreach ($users as $user)

                                <div class="ceb-item-style-2">
                                    <img src="/images/users/{{ $user->avatar }}" alt="" width="115px">
                                    <div class="ceb-infor">
                                        <h2><a href="/users/{{ $user->id }}">{{ $user->firstName }}
                                                {{ $user->lastName }}</a>
                                        </h2>
                                        <span>{{ $user->country }}, {{ $user->city }}</span>
                                        <p>{{ $user->description }} </p>
                                    </div>
                                </div>


                            @endforeach
                            {{-- {{ $casts->links() }} --}}
                        </div>

                    </div>

                </div>
                <div class="col-md-3 col-xs-12 col-sm-12">
                    <div class="sidebar">
                        <div class="celebrities">
                            @auth
                                <h4 class="sb-title">Suggested for you</h4>
                            @endauth
                            @guest
                                <h4 class="sb-title">Join us</h4>
                            @endguest
                            @foreach ($mostActive as $ma)
                                <div class="celeb-item">
                                    <a href="#"><img src="/images/users/{{ $ma->avatar }}" alt="" width="70px"></a>
                                    <div class="celeb-author">
                                        <h6><a href="/users/{{ $ma->id }}">{{ $ma->firstName }} {{ $ma->lastName }}</a></h6>
                                        @auth
                                            <span><a href="/followUser/{{ $ma->id }} " class="btn-xs">Follow</a></span>
                                        @endauth
                                        @guest
                                            <span>
                                                <a href="#" class="btn-xs">Follow</a></span>
                                        @endguest
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end of celebrity list section-->

@endsection
