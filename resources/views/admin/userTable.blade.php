@extends('tablesLayout')
@section('userTable')
    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title ">User table</h4>
            <p class="card-category"> List of all users</p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class=" text-primary">
                        <th>
                            ID
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            Username
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            Country
                        </th>
                        <th>
                            City
                        </th>
                        <th>
                            Action
                        </th>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="text-primary">
                                    {{ $user->id }}
                                </td>
                                <td>
                                    {{ $user->firstName }} {{ $user->lastName }}
                                </td>
                                <td>
                                    {{ $user->username }}
                                </td>
                                <td>
                                    {{ $user->email }}
                                </td>
                                <td>
                                    {{ $user->country }}
                                </td>
                                <td>
                                    {{ $user->city }}
                                </td>
                                <td>
                                    <a href="/users/{{ $user->id }}"><i
                                            class="fa fa-user"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a
                                        href="/users/delete/{{ $user->id }}"><i class="fa fa-trash"> </i></a>
                                        &nbsp;&nbsp;&nbsp;<a
                                        href="/users/ban/{{ $user->id }}"><i class="fa fa-ban"> </i></a>
                                </td>
                            </tr>
                        @endforeach



                    </tbody>

                </table>
                <br>
                <div class="justify-content-center">{{ $users->links() }}</div>
            @endsection
