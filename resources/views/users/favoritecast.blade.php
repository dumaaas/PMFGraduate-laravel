@extends('userLayout')
@section('favoriteCastList')
    <div class="col-md-9 col-sm-12 col-xs-12">
        <div class=" title-hd-sm">
            <h4>List of favorite cast <i class="ion-ios-arrow-right"></i></h4>

        </div>
        <div class="flex-wrap-movielist grid-fav">
            @foreach ($favorites as $favorite)

                <div class="movie-item-style-2 movie-item-style-1 style-3">
                    <img src="/images/actors/{{ $favorite->likeable->avatar }}" alt="">
                    <div class="hvr-inner">
                        <a href="/cast/{{ $favorite->likeable->id }}"> See <i class="ion-android-arrow-dropright"></i>
                        </a>
                    </div>
                    <div class="mv-item-infor">
                        <h6><a href="/cast/{{ $favorite->likeable->id }}">{{ $favorite->likeable->firstName }}
                                {{ $favorite->likeable->lastName }}</a>
                        </h6>

                    </div>
                </div>

            @endforeach
        </div>
        <div class="justify-content-center">{{ $favorites->links() }}</div>

    </div>

@endsection
