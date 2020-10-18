@extends('tablesLayout')
@section('commentTable')
    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title ">Comment table</h4>
            <p class="card-category"> List of all comments</p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class=" text-primary">
                        <th>
                            Movie
                        </th>
                        <th>
                            Author
                        </th>
                        <th>
                            Text
                        </th>
                        <th>
                            Created date
                        </th>
                        <th>
                            Action
                        </th>
                    </thead>
                    <tbody>
                        @foreach ($comments as $comment)
                            <tr>
                                <td class="text-primary">
                                    <a href="/movies/{{ $comment->movie->id }}"> {{ $comment->movie->name }} </a>
                                </td>
                                <td>
                                    <a href="/users/{{ $comment->user->id }}"> {{ $comment->user->username }} </a>
                                </td>
                                <td>
                                    {{ Str::limit($comment->content, 30) }}
                                </td>
                                <td>
                                    {{ $comment->created_at->format('Y-m-d H:i:s') }}
                                </td>
                                <td>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="/comments/delete/{{ $comment->id }}"><i
                                            class="fa fa-trash"> </i></a>
                                </td>
                            </tr>
                        @endforeach



                    </tbody>

                </table>
                <br>
                {{ $comments->links() }}
            @endsection
