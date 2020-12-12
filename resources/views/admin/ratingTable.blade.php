@extends('tablesLayout')
@section('ratingTable')
    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title ">Rating table</h4>
            <p class="card-category"> List of all ratings</p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <rating-table></rating-table>
                <br>
            </div>
        </div>
    </div>
@endsection
