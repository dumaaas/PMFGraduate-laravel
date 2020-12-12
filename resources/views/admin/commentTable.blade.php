@extends('tablesLayout')
@section('commentTable')
    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title ">Comment table</h4>
            <p class="card-category"> List of all comments</p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
               <comment-table></comment-table>
            </div>
        </div>
    </div>
@endsection
