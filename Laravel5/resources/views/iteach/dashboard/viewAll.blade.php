@extends('dash-guest')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                View All <small>Guest</small>
            </h1>                       
        </div>
    </div>

    <div>
        <div class="panel-group" id="accordion">

        @for($i=0; $i<count($sections); $i++)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion{{$i}}" href="#collapse{{$i}}">{{$sections[$i]->courseNum}} - {{$sections[$i]->courseTitle}}</a>
                        </h4>
                    </div>
                    <div id="collapse{{$i}}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <div><strong>Semester Offered:</strong> {{$sections[$i]->semOffered}}&nbsp&nbsp&nbsp&nbsp&nbsp<strong>Prerequisites:</strong> {{$sections[$i]->preReq}} </div>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Section</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Day</th>
                                            <th>Room</th>
                                            <th>Instructor</th>
                                        </tr>
                                    </thead>
                                        <?php $cn = $sections[$i]->courseNum; ?>
                                        @while ($i<count($sections) && $cn == $sections[$i]->courseNum)
                                            <tr>
                                                @if (str_contains( $sections[$i]->type, 'Lect')) <td>Lecture</td>
                                                @else <td></td>
                                                @endif
                                                <td>{{$sections[$i]->sectionNum}}</td>
                                                <td>{{$sections[$i]->startTime}}</td>
                                                <td>{{$sections[$i]->endTime}}</td>
                                                <td>{{$sections[$i]->day}}</td>
                                                <td>{{$sections[$i]->roomNum}}</td>
                                                <td>{{$sections[$i]->lname}}</td>
                                                <td>{{$sections[$i]->class_size}}</td>                                    
                                                </tr>
                                            <?php $i++; ?>
                                        @endwhile
                                        <?php $i--; ?> <!-- Above loop will skip an index. This line prevents that to happen -->
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        @endfor
        <!--{{$sections}}-->
                        
        </div>
    </div>
@endsection