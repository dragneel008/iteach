@extends('dash-guest')

@section('content')
    <div class="row">
	<div class="col-lg-12">
	    <h1 class="page-header">
		Instructors <small>Guest</small>
	    </h1>
	    <div id="wrap">
		    <ul id="gallery">
		    	<?php $j = 0; ?>
			    @for($i=0; $i<count($allInstructors); $i++)
				    <?php $image = "profile/".$allInstructors[$i]->employeeId.".jpg"?>	<!-- Get the directory of Image -->
				    <?php $haveSched=false; ?>
				    <li id= "teach">
					    <a data-toggle="modal" data-target="#openModal{{$i}}"><img src="{{$image}}" onerror="this.src='profile/100.jpg'"> </a>
						    <div id="label">
							    {{$allInstructors[$i]->fname}} {{$allInstructors[$i]->lname}}<br>
						    </div>
						    
					    <div id="openModal{{$i}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="purchaseLabel" aria-hidden="true">
						<div class="modal-dialog">
							<a href="#close" title="Close" class="close">X</a>
							<div class="modal-content">
							    <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="purchaseLabel">{{$allInstructors[$i]->fname}} {{$allInstructors[$i]->lname}}<br></h4>
							    </div>
							    <div class="modal-body">
								<div class="panel-body">
									<?php if($j<count($instructors) && $allInstructors[$i]->employeeId == $instructors[$j]->employeeId) $haveSched=true; ?>
								    @if ($haveSched)
								    <div class="table-responsive">
									<table class="table table-hover">
									    <thead>
										<tr>
										    <th>Course Number</th>
										    <th>Section</th>
										    <th>Start Time</th>
										    <th>End Time</th>
										    <th>Day</th>
										    <th>Room</th>
										    <th>Units</th>
										</tr>
									    </thead>                  
									    <?php 
									    	$eid = $allInstructors[$i]->employeeId;
									    	$inTheLoop = false;
									    ?>
									    @while ($j < count($instructors) && $eid == $instructors[$j]->employeeId)
											<tr>
											    <td>{{$instructors[$j]->courseNum}}</td>
											    <td>{{$instructors[$j]->sectionNum}}</td>
											    <td>{{$instructors[$j]->startTime}}</td>
											    <td>{{$instructors[$j]->endTime}}</td>
											    <td>{{$instructors[$j]->day}}</td>
											    <td>{{$instructors[$j]->roomNum}}</td>
											    <td>{{$instructors[$j]->studentUnits}}</td>                                      
											</tr>
											<?php $j++; $inTheLoop=true; ?>
									    @endwhile
									</table>
								    </div>
								    @else
								    	<p>There is no schedule available</p>
								    @endif
								</div>
							    </div>
							    <div class="modal-footer">
								<!--button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<button type="button" class="btn btn-primary">Purchase</button-->
								<p>Somethings</p>
							    </div>
							</div>
						</div>
					    </div>
				    </li>
			    @endfor
		    </ul>
	    </div>
	</div>
    </div>
    
    
@endsection