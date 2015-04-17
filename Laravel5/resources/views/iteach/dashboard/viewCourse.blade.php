@extends('dash-guest')

@section('content')
    <script type="text/javascript">
        $(document).ready(function(){
            $("select").change(function(){
                $( "select option:selected").each(function(){
                    if($(this).attr("value")!="default"){
                        $(".box").hide();
                        $("."+$(this).attr('value')).show();
                    }
                });
            }).change();
        });
    </script>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                View Course <small>Guest</small>
            </h1>                       
        </div>
    </div>
    <div>
          <select class="form-control" id="employee" name="employee">
            <?php $sect=null; $counter=0;?>
            <option value="default" disabled selected>Select Course</option>
            @for($i = 0; $i<count($sections); $i++)
                @if($sect != $sections[$i]->courseNum)
                     <option value="divtab{{$counter}}">{{$sections[$i]->courseNum}}</option>
                    <?php $sect=$sections[$i]->courseNum;
                    $counter++; ?>
                @endif
            @endfor
        </select>
    </div>
    <?php $sect=null; $counter=0;?>
    @for($i = 0; $i<count($sections); $i++)
    <div class="divtab{{$counter}} box" style="display:none" hidden>
        <div class="table-responsive">
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
                        </tr>
                    <?php $i++; ?>

                @endwhile
                <?php $i--; $counter++; ?> <!-- Above loop will skip an index. This line prevents that to happen -->
            </table>
        </div>
    </div>
   
    @endfor
@endsection