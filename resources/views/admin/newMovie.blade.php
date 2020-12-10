@extends('adminLayout')
@section('newMovie')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Add new movie</h4>
                            <p class="card-category">Complete movie informations</p>
                        </div>
                        <div class="card-body">
                            <form method="POST"  action="/addMovie" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Movie name</label>
                                            <input type="text" class="form-control" name="name">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Genre</label>
                                            <input type="text" class="form-control" name="genre">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Release year</label>
                                            <input type="text" class="form-control" name="releaseYear">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">iMDB</label>
                                            <input type="text" class="form-control" name="imdb">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Duration</label>
                                            <input type="text" class="form-control" name="duration">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Trailer</label>
                                            <input type="text" class="form-control" name="trailer">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <div class="form-group">

                                                <textarea class="form-control" rows="5" name="description"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Select actors</label><br>
                                            <select id="dates-field2" name="actors[]" class="custom-select valid" multiple="multiple" required>
                                                @foreach ($actors as $actor)
                                                <option value="{{$actor->id}}">{{$actor->firstName}} {{$actor->lastName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <label>Upload movie cover</label>
                                        <div class="file-field">
                                            <div class="btn btn-primary btn-sm float-left">

                                              <input type="file" name="avatar">
                                            </div>


                                        </div>

                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary pull-right">Add new movie</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
