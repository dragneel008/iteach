@extends('iteach.admin.dash-admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Edit Minor Room Details <small>Admin {{ Auth::user()->username }} </small>
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-lg-offset-1">
            <form class="form form-horizontal well" method="post" action="getRoom">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <div class="col-lg-3 form-label">
                        <label>Room Number: </label>
                    </div>
                    <div class="col-lg-8">
                        <select class="form-control" name="roomNumber" id="roomNumber">
                            <option value="null" selected></option>
                            @foreach($rooms as $room)
                                <option value="{{ $room->roomNum }}">{{ $room->roomNum }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-4 col-lg-offset-3">
                        <button type="submit" class="btn btn-default">Submit</button>
                        <button type="reset" class="btn btn-default">Clear</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection    

