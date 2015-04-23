<!-- 




 -->
 
@extends('iteach.admin.dash-admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Edit {{$room[0]}}'s Capacity  <small>Admin {{ Auth::user()->username }} </small>
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-lg-offset-1">
            <form class="form form-horizontal well" method="post" action="editRoomCapacity">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="roomNumber" value="{{ $room[0] }}">
                <div class="form-group">
                    <div class="col-lg-3">
                        <label class="form-label">New Capacity:</label>
                    </div>
                    <div class="col-lg-8">
                        <input type="number" class="form-control" name="roomCapacity" id="roomCapacity" min="10" value="{{$room[1]}}"/> 
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-4 col-lg-offset-3">
                        <button type="submit" class="btn btn-default">Submit</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection    

