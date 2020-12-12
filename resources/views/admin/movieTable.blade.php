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

                <movie-table></movie-table>

            </div>
        </div>
    </div>
@endsection
