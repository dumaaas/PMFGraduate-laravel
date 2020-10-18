@extends('userLayout')
@section('watchedList')
<div class="col-md-9 col-sm-12 col-xs-12">
    <div class=" title-hd-sm">
        <h4>List of watched movies <i class="ion-ios-arrow-right"></i></h4>

    </div>
    <div class="flex-wrap-movielist grid-fav">
        @foreach ($watcheds as $watched)

            <div class="movie-item-style-2 movie-item-style-1 style-3">
                <img src="/images/movies/{{$watched->movie->avatar}}" alt="">
                <div class="hvr-inner">
                    <a href="/movies/{{ $watched->movie->id }}"> See <i
                            class="ion-android-arrow-dropright"></i>
                    </a>
                </div>
                <div class="mv-item-infor">
                    <h6><a href="/movies/{{ $watched->movie->id }}">{{ $watched->movie->name }}</a>
                    </h6>
                    <p class="rate"><i class="ion-android-star"></i><span>{{ $watched->movie->imdb }}</span>
                        /10
                    </p>
                </div>
            </div>

        @endforeach

    </div>
    {{ $watcheds->links() }}
</div>


    @endsection
