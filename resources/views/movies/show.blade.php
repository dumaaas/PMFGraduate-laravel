@extends('layout')
@section('showMovie')
    <div class="hero mv-single-hero">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                </div>
            </div>
        </div>
    </div>
    <div class="page-single movie-single movie_single">
        <div class="container">
            <div class="row ipad-width2">
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="movie-img">
                        <img src="/images/movies/{{ $movie->avatar }}" alt="">
                        <div class="movie-btn">
                            <div class="btn-transform transform-vertical red">
                                <div>
                                    <a href="#" class="item item-1 redbtn">
                                        <i class="ion-play"></i> Watch Trailer
                                    </a>
                                </div>
                                <div>
                                    <a href="{{ $movie->trailer }}" class="item item-2 redbtn fancybox-media hvr-grow">
                                        <i class="ion-play"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="btn-transform transform-vertical">
                                <div>
                                    <a class="item item-1 yellowbtn">
                                        <i class="ion-checkmark"></i>
                                    </a>
                                </div>
                                <div>
                                    <a class="item item-2 yellowbtn">
                                        <movie-list :type="'watched'" :movie="{{$movie}}" :isinmovielist="{{$movie->isInMovieList('favorite') ? 'true' : 'false'}}"></movie-list>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="movie-btn">
                            <movie-reminder :movie="{{$movie}}"></movie-reminder>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <div class="movie-single-ct main-content">
                        <h1 class="bd-hd">{{ $movie->name }} <span> {{ $movie->releaseYear }}</span></h1>
                        <div class="social-btn">
                            <movie-list :type="'favorite'" :movie="{{$movie}}" :isinmovielist="{{$movie->isInMovieList('favorite') ? 'true' : 'false'}}"></movie-list>
                            <movie-list :type="'custom'" :movie="{{$movie}}" :isinmovielist="{{$movie->isInMovieList('custom') ? 'true' : 'false'}}"></movie-list>
                            <movie-list :type="'watchlist'" :movie="{{$movie}}" :isinmovielist="{{$movie->isInMovieList('watchlist') ? 'true' : 'false'}}"></movie-list>
                        </div>
                        <div class="movie-rate">
                            <div class="rate">
                                <i class="ion-android-star"></i>
                                <p><span>{{ $rating }}</span> /10<br>
                                    <span class="rv">{{ $ratingNum }} reviews</span>
                                </p>
                            </div>
                            <div class="rate-star">
                                <p>Rate This Movie: </p>
                                <movie-rating :movie="{{$movie}}" :rating="{{$userRating}}"></movie-rating>
                            </div>
                        </div>
                        <div class="movie-tabs">
                            <div class="tabs">
                                <ul class="cont4 tab-links tabs-mv">
                                    <li class=" active"><a href="#overview">Overview</a></li>
                                    <li><a href="#comments">Comments</a></li>
                                    <li><a href="#reviews">Reviews</a></li>
                                </ul>
                                <br>
                                <div class="tab-content">
                                    <div id="overview" class="tab active">
                                        <div class="row">
                                            <div class=" cont1 col-md-8 col-sm-12 col-xs-12">
                                                <div class=" title-hd-sm">
                                                    <h4>About <i class="ion-ios-arrow-right"></i></h4>
                                                </div>
                                                <p>{{ $movie->description }}</p>
                                                <div class="title-hd-sm">
                                                    <h4>Full Cast & Crew <i class="ion-ios-arrow-right"></i></h4>
                                                </div>
                                                <!-- movie cast -->
                                                @foreach ($actings as $acting)
                                                    <div class="mvcast-item">
                                                        <div class="cast-it">
                                                            <div class="cast-left">
                                                                <img src="/images/actors/{{ $acting->cast->avatar }}"
                                                                    style="width:60px; height:70px; float:left; border-radius:50%; margin-right:25px;"
                                                                    alt="">
                                                                <a href="/cast/{{ $acting->cast->id }}">{{ $acting->cast->firstName }}
                                                                    {{ $acting->cast->lastName }} </a>
                                                            </div>
                                                            <p>... {{ $acting->cast->movieName }} </p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="cont2 col-md-4 col-xs-12 col-sm-12">
                                                <div class="sb-it">
                                                    <h6>Director: </h6>
                                                    <p>
                                                        David Fincher {{-- <a
                                                            href="/cast/{{ $director->id }}">{{ $director->firstName }}
                                                            {{ $director->lastName }}</a>
                                                        --}}
                                                    </p>
                                                </div>
                                                <div class="sb-it">
                                                    <h6>Stars: </h6>
                                                    <p>
                                                        @foreach ($stars as $star)
                                                            <a href="/cast/{{ $star->cast->id }}">{{ $star->cast->firstName }}
                                                                {{ $star->cast->lastName }}</a>
                                                            <br />
                                                        @endforeach
                                                    </p>
                                                </div>
                                                <div class="sb-it">
                                                    <h6>Genre:</h6>
                                                    <p><a href="#">{{ $movie->genre }}</a></p>
                                                </div>
                                                <div class="sb-it">
                                                    <h6>Release Date:</h6>
                                                    <p>{{ $movie->releaseYear }}</p>
                                                </div>
                                                <div class="sb-it">
                                                    <h6>Run Time:</h6>
                                                    <p>{{ $movie->duration }} min</p>
                                                </div>
                                                <div class="sb-it">
                                                    <h6>imDB Rating:</h6>
                                                    <p>{{ $movie->imdb }}/10</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="comments" class="tab blog-detail-ct">
                                        @auth
                                            <div class="comment-form">
                                                <h4>Leave a comment</h4>
                                                <form action="/addComment/{{ $movie->id }}" method="post">
                                                    @csrf

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <textarea name="content" id="" placeholder="Comment"></textarea>
                                                        </div>
                                                    </div>
                                                    <input class="submit" type="submit" value="submit">
                                                </form>
                                            </div>
                                        @endauth
                                        @guest
                                            <div class="comment-form">
                                                <h4><a href='/register'>Join us in order to comment</a></h4>
                                                <form action="/addComment/{{ $movie->id }}" method="post">
                                                    @csrf

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <textarea name="content" id="" placeholder="Comment"
                                                                disabled></textarea>
                                                        </div>
                                                    </div>
                                                    <input class="submit" type="submit" value="submit" disabled>
                                                </form>
                                            </div>
                                        @endguest
                                        <h4>{{ $sumComments }} comments</h4>
                                        @foreach ($comments as $comment)
                                            <div class="cmt-item flex-it">
                                                <img src="/images/users/{{ $comment->user->avatar }}" alt=""
                                                    style="border-radius: 50%" width="75px">
                                                <div class="author-infor">
                                                    <div class="flex-it2">
                                                        <h6>
                                                            <a href="/users/{{ $comment->user->id }}">{{ $comment->user->username }}</a>
                                                        </h6>
                                                        <span class="time"> {{ $comment->created_at->diffForHumans() }}</span>
                                                    </div>
                                                    <p>{{ $comment->content }}</p>
                                                    @auth
                                                        <p><a href="{{route('likeable.comment', ['comment' => $comment->id, 'type' => 'up'])}}"><i class="{{$comment->isCommentLiked($comment->id) ? 'blue fa fa-thumbs-up' : 'fa fa-thumbs-up'}}"></i></a>     <a href="{{route('likeable.comment', ['comment' => $comment->id, 'type' => 'down'])}}"><i class="{{!$comment->isCommentLiked($comment->id) ? 'blue fa fa-thumbs-down' : 'fa fa-thumbs-down'}}"></i></a>  </p>
                                                    @endauth
                                                </div>
                                            </div>
                                        @endforeach
                                        {{ $comments->links() }}
                                        <!-- comment form -->
                                    </div>
                                    <div id="reviews" class="tab blog-detail-ct">
                                        <div class="comment-form2">
                                            <h4>Rate this movie</h4>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <movie-rating :movie="{{$movie}}" :rating="{{$userRating}}"></movie-rating>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <h4>{{ $ratingNum }} ratings</h4>
                                        @foreach ($ratings as $rating)
                                            <div class="cmt-item flex-it">
                                                <img src="/images/users/{{ $rating->user->avatar }}" alt=""
                                                     style="border-radius: 50%" width="75px">
                                                <div class="author-infor">
                                                    <div class="flex-it2">
                                                        <h6>
                                                            <a href="/users/{{ $rating->user->id }}">{{ $rating->user->username }}</a>
                                                        </h6> <span class="time"> {{ $rating->created_at->diffForHumans() }}</span>
                                                    </div>
                                                    <div class="rate2">
                                                        @for ($i = 0; $i < $rating->rating; $i++)
                                                            <i class="ion-android-star"></i>
                                                        @endfor
                                                            @for ($i = $rating->rating; $i < 10; $i++)
                                                                <i class="ion-android-star-outline"></i>
                                                            @endfor
                                                    </div>
                                                    <p>{{ $rating->review }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
