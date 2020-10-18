@extends('tablesLayout')
@section('movieTable')
    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title ">Movie table</h4>
            <p class="card-category"> List of all movies</p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <a href="/report" class="btn"><i class="fa fa-file-pdf-o"></i> Report</a>
                <table class="table">
                    <thead class=" text-primary">
                        <th>
                            ID
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            Genre
                        </th>
                        <th>
                            imDB
                        </th>
                        <th>
                            Year
                        </th>
                        <th>
                            Duration
                        </th>
                        <th>
                            Action
                        </th>
                    </thead>
                    <tbody>
                        @foreach ($movies as $movie)
                            <tr>
                                <td class="text-primary">
                                    {{ $movie->id }}
                                </td>
                                <td>
                                    {{ $movie->name }}
                                </td>
                                <td>
                                    {{ $movie->genre }}
                                </td>
                                <td>
                                    {{ $movie->imdb }}/10
                                </td>
                                <td>
                                    {{ $movie->releaseYear }}
                                </td>
                                <td>
                                    {{ $movie->duration }} min
                                </td>
                                <td>
                                    <a href="/movies/{{ $movie->id }}"><i class="fa fa-film"></i></a>&nbsp;&nbsp;
                                    <a href="/editMovie/{{ $movie->id }}"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                    <a href="/movies/delete/{{ $movie->id }}"><i class="fa fa-trash"> </i></a>

                                </td>
                            </tr>
                        @endforeach



                    </tbody>

                </table>
                <br>
                 {{ $movies->links() }} 
            @endsection
