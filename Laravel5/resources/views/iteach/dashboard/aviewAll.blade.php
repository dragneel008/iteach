@extends('iteach/admin/dash-admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                View All <small>Admin {{ Session::get('userInst')['fname'] }}</small>
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
                                            <th></th>
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

                                                <td><a href="#{{$i}}" id="{{$sections[$i]->sectionNum}}" class="btn btn-default btn-block" data-toggle="modal">ASSIGN</a></td>

                                                <div class="modal fade" id="{{$i}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title">ASSIGN [{{$sections[$i]->courseNum}}] <em>{{$sections[$i]->sectionNum}}</em></h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h4>Select a field to edit</h4>

                                                            <div role="tabpanel" style="margin-bottom: 3%">
                                                                <ul class="nav nav-tabs">
                                                                    <li role="presentation" class="active"><a href="#editCourseName" role="tab" data-toggle="tab">Course name</a></li>
                                                                    <li role="presentation"><a href="#editInstructor" role="tab" data-toggle="tab">Instructor</a></li>
                                                                </ul>

                                                            </div>

                                                            <div class="tab-content">
                                                                
                                                                 <div role="tabpanel" class="tab-pane fade in active" id="editCourseName" style="margin-left: 3%; margin-right: 3%;">
                                                                    <form>
                                                                        <div class="form-group">
                                                                            <label for="newCourseName">Enter new course name</label>
                                                                            <input type="text" class="form-control" id="newCourseName">
                                                                        </div>
                                                                        <div class="form-group">
                                                                             <button type="submit" class="btn btn-default">Submit</button>
                                                                        </div>
                                                                    </form>
                                                                </div>

                                                                <div role="tabpanel" class="tab-pane fade" id="editInstructor">
                                                                    <form method="POST" action="{{ url('/assignInstructor') }}">
                                                                        <input type="hidden" name="section" value="{{ $sections[$i]->sid }}">
                                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                        <div class="form-group">
                                                                            <label for="newInstructor">Assign New Instructor</label>
                                                                            
                                                                                <select class="form-control" id="assignEmployee" name="assignEmployee">
                                                                                        @foreach($instructors as $instructor)
                                                                                        <option value="{{ $instructor->employeeId }}">
                                                                                            {{$instructor->lname}},
                                                                                            {{$instructor->fname}}
                                                                                        </option>
                                                                                        @endforeach    
                                                                                </select> 
                                                                            
                                                                        </div>
                                                                        <div class="form-group">
                                                                             <button type="submit" class="btn btn-default">Submit</button>
                                                                        </div>
                                                                    </form>
                                                                </div>  
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                <td>

                                                    <form method="GET" action="{{ url('/createSwapRequest') }}" style="float:left;">
                                                       <input type="hidden" name="class" value="{{ $sections[$i]->sid }}">
                                                       <input type="submit" value="Request Swap">
                                                    </form>

                                                </td>  
                                                                                 
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