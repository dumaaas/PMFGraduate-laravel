@extends('tablesLayout')
@section('ratingTable')
    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title ">Rating table</h4>
            <p class="card-category"> List of all ratings</p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class=" text-primary">
                        <th>
                            Movie
                        </th>
                        <th>
                            User
                        </th>
                        <th>
                            Rating
                        </th>
                        <th>
                            Created date
                        </th>
                        <th>
                            Action
                        </th>
                    </thead>
                    <tbody>
                        @foreach ($ratings as $rating)
                            <tr>
                                <td class="text-primary">
                                    <a href="/movies/{{ $rating->movie->id }}"> {{ $rating->movie->name }} </a>
                                </td>
                                <td>
                                    <a href="/users/{{ $rating->user->id }}"> {{ $rating->user->username }} </a>
                                </td>
                                <td>
                                    <i class="fa fa-star"></i> {{ $rating->rating }}/10
                                </td>
                                <td>
                                    {{ $rating->created_at->format('Y-m-d H:i:s') }}
                                </td>
                                <td>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/ratings/delete/{{$rating->movie->id}}/{{$rating->user->id}}"><i
                                            class="fa fa-trash"> </i></a>
                                </td>
                            </tr>
                        @endforeach



                    </tbody>

                </table>
                <br>
                {{ $ratings->links() }}
            @endsection
