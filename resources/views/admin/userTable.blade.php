@extends('tablesLayout')
@section('userTable')
    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title ">User table</h4>
            <p class="card-category"> List of all users</p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <user-list></user-list>
            </div>
        </div>
    </div>
@endsection
