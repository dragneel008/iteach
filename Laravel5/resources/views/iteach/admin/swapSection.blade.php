@extends('iteach.admin.dash-admin')

@section('content')
    <!-- 
        TODO
            Swap Section Stuff Here
     -->

     <!-- Etong buong page yung nabago-->
     <div class="row">
        <div lcass="col-lg-12">
            <h1 class="page-header">
                Swap Section <small>Admin {{ Auth::user()->username }}</small>
            </h1>
        </div>
     </div>

     <div class="row">
        <div class="col-lg-12">
            <form class="form-horizontal" method="post" action="#">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <div class="col-lg-2 col-lg-offset-1">
                        <label>Course Number:</label>
                    </div>
                    <div class="col-lg-3">
                        <select class="form-control">
                            <option value="null" selected></option>
                            @foreach( $courses as $course)
                                <option value="{{ $course->courseNum }}">{{ $course->courseNum }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-2">
                        <label>Course Section:</label>
                    </div>
                    <div class="col-lg-3">
                        <select class="form-control">
                            <option value="null" selected></option>
                            <!-- AJAX HERE -->
                        </select>
                    </div>  
                </div>

                <div class="form-group">
                    <div class="col-lg-2 col-lg-offset-1">
                        <label>Assigned Room:</label>
                    </div>
                    <div class="col-lg-8">
                        @if(count($rows))
                            <select class="form-control">
                                <option value="null" selected></option>
                                @foreach( $rows as $data)
                                    <option value="{{ $data->roomNum }}">{{ $data->roomNum }}</option>
                                @endforeach
                            </select>
                        @else
                            <select class="form-control" disabled>
                                <option value="null" selected>NO Rooms AS OF THE MOMENT</option>
                            </select>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-2 col-lg-offset-1">
                        <label>Old Room:</label>
                    </div>
                    <div class="col-lg-8">
                        @if(count($rows))
                            <select class="form-control">
                                <option value="null" selected></option>
                                @foreach( $rows as $data)
                                    <!--<option value="{{ $data->roomNum }}">-->
                                        <!--{{ $data->roomNum }}-->
                                    <option value="{{ $data -> join('sections', 'rooms.roomNum', '=', 'rooms.roomNum')->select('rooms.roomNum')->get()}}">  
                                        <!-- $data -> join('rooms', 'sections.roomNum', '=', 'rooms.roomNum')->select('sections.roomNum')->get(); -->
                                        <!-- {{$data -> join('sections', 'rooms.roomNum', '=', 'rooms.roomNum')->select('rooms.roomNum')->where('rooms.roomNum','=','TBA')->get()}} -->
                                        <!-- {{ $data->roomNum }} -->

                                    </option>
                                @endforeach
                            </select>
                        @else
                            <select class="form-control" disabled>
                                <option value="null" selected>NO SECTIONS AS OF THE MOMENT</option>
                            </select>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-offset-5">
                        <button type="submit" class="btn btn-default"> Swap Rooms</button>
                        <button type="reset" class="btn btn-default"> Reset</button>
                    </div>
                </div>
            </form>
        </div>


        <!--dynamic swap sana using yung information galing sa unang form kaso di ko nagawa yung ajax, pero nakalagay na dito yung swap na mano mano -->
        <!-- <div class="col-lg-12">
            <form class="form-horizontal" method="post" action="#">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

            </form>
        </div> -->
        
     </div>


        

@endsection

