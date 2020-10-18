@extends('userLayout')
@section('favoriteList')
    <div class="col-md-9 col-sm-12 col-xs-12">
        <div class=" title-hd-sm">
            <h4>List of favorite movies <i class="ion-ios-arrow-right"></i></h4>

        </div>
        <div class="flex-wrap-movielist grid-fav">
            @foreach ($favorites as $favorite)

                <div class="movie-item-style-2 movie-item-style-1 style-3">
                    <img src="/images/movies/{{ $favorite->movie->avatar }}" alt="">
                    <div class="hvr-inner">
                        <a href="/movies/{{ $favorite->movie->id }}"> See <i class="ion-android-arrow-dropright"></i>
                        </a>
                    </div>
                    <div class="mv-item-infor">
                        <h6><a href="/movies/{{ $favorite->movie->id }}">{{ $favorite->movie->name }}</a>
                        </h6>
                        <p class="rate"><i class="ion-android-star"></i><span>{{ $favorite->movie->imdb }}</span> /10
                        </p>
                    </div>
                </div>

            @endforeach

        </div>
        <div class="justify-content-center">{{ $favorites->links() }}</div>
    </div>
@endsection
