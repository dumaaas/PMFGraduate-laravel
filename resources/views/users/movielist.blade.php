@extends('userLayout')
@section('movieList')
    <div class="col-md-9 col-sm-12 col-xs-12">
        <div class=" title-hd-sm">
            <h4>List of {{$type}} movies <i class="ion-ios-arrow-right"></i></h4>

        </div>
        <div class="flex-wrap-movielist grid-fav">
            @foreach ($movielist as $mv)

                <div class="movie-item-style-2 movie-item-style-1 style-3">
                    <img src="/images/movies/{{ $mv->movie->avatar }}" alt="">
                    <div class="hvr-inner">
                        <a href="/movies/{{ $mv->movie->id }}"> See <i class="ion-android-arrow-dropright"></i>
                        </a>
                    </div>
                    <div class="mv-item-infor">
                        <h6><a href="/movies/{{ $mv->movie->id }}">{{ $mv->movie->name }}</a>
                        </h6>
                        <p class="rate"><i class="ion-android-star"></i><span>{{ $mv->movie->imdb }}</span> /10
                        </p>
                    </div>
                </div>

            @endforeach

        </div>
        <div class="justify-content-center">{{ $movielist->links() }}</div>
    </div>
@endsection
