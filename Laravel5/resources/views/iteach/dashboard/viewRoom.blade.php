@extends('dash-guest')

@section('content')
    <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Rooms <small>Guest</small>
                        </h1>
                    </div>
                </div>
                <div class="bs-example col-lg-11">
                    <div class="panel-group" id="accordion">
                    <?php $sectionCounter = 0; ?>
                    @for ($i = 0;$i<count($rooms)-1; $i++)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion{{$i}}" href="#collapse{{$i}}">{{$rooms[$i]->roomNum}}</a>
                                </h4>
                            </div>
                            <div id="collapse{{$i}}" class="panel-collapse collapse">
                                <div class="panel-body">
                                	<!-- 
                                	-------------------------------------------------------
                                		
                                		LOAD EMPTY TABLE 

                                	-------------------------------------------------------
                                	-->
									<table id="tg{{$i}}" class="tg">
									  <tr>
									    <th class="tg-vx3v" colspan="6">{{$rooms[$i]->roomNum}}</th>
									  </tr>
									  <tr>
									    <td class="tg-7l82">Time / Day</td>
									    <td class="tg-7l82">Monday</td>
									    <td class="tg-7l82">Tuesday</td>
									    <td class="tg-7l82">Wednesday</td>
									    <td class="tg-7l82">Thursday</td>
									    <td class="tg-7l82">Friday</td>
									  </tr>
									  <!-- Schedule from -->
									  @for($j=7; $j!=12; $j++)
										<tr>
									    	<td class="tg-jecd">{{$j}}:00 - {{$j+1}}:00</td>
									    	<td class="tg-031e Mt{{$j}}"></td>
									    	<td class="tg-031e Tt{{$j}}"></td>
									    	<td class="tg-031e Wt{{$j}}"></td>
									    	<td class="tg-031e THt{{$j}}"></td>
									    	<td class="tg-031e Ft{{$j}}"></td>
										</tr>
									  @endfor
									  	<tr>
									    	<td class="tg-jecd">12:00 - 1:00</td>
									    	<td class="tg-031e Mt12"></td>
									    	<td class="tg-031e Tt12"></td>
									    	<td class="tg-031e Wt12"></td>
									    	<td class="tg-031e THt12"></td>
									    	<td class="tg-031e Ft12"></td>
										</tr>
									  @for($j=1; $j!=7; $j++)
										<tr>
									    	<td class="tg-jecd">{{$j}}:00 - {{$j+1}}:00</td>
											<td class="tg-031e Mt{{$j}}"></td>
									    	<td class="tg-031e Tt{{$j}}"></td>
									    	<td class="tg-031e Wt{{$j}}"></td>
									    	<td class="tg-031e THt{{$j}}"></td>
									    	<td class="tg-031e Ft{{$j}}"></td>
										</tr>
									  @endfor
									</table>
									<!-- 
                                	-------------------------------------------------------
                                		
                                		Add slots to table

                                	-------------------------------------------------------
                                	-->
									<script type="text/JavaScript">
									@while($sectionCounter < count($sections) && $rooms[$i]->roomNum == $sections[$sectionCounter]->roomNum)
									 	$(function () {
									 		<?php
									 			$courseNumString = $sections[$sectionCounter]->courseNum;
									 			$sectNumString = $sections[$sectionCounter]->sectionNum;
									 			$dayString = $sections[$sectionCounter]->day;
												$startString = str_replace(":00","",$sections[$sectionCounter]->startTime);
												$endString = str_replace(":00","",$sections[$sectionCounter]->endTime);

												// Convert to military time
												if($startString < 7 && $startString > 0){
													$startString1 = $startString + 12;
												}
												if($endString < 8 && $endString > 0){
													$endString1 = $endString + 12;
												}

												if($dayString != "TBA" && $startString != "TBA" && $endString != "TBA"){
												   $day = strtok($dayString,"/");
												   $timeLen = $endString1 - $startString1;
												   $timeLen = abs($timeLen);
												   while($day !== false){
												   		// Insert slot with rowspan
												   		$selector = "'table#tg".$i." tr td.".$day.'t'.$startString."'";
												   		echo ("$($selector).attr('rowspan', $timeLen);");

												   		// Insert course number and section to slot
											       		if($timeLen==1) echo ("$($selector).text('$courseNumString $sectNumString');");	// Lecture
											       		else echo ("$($selector).html('$courseNumString<br>$sectNumString');");			// Lab

											       		// If course is held more than one day
											       		for($j=1; $j < $timeLen; $j++){
											       			$newT = $startString+$j;
											       			$selector1 = "'table#tg".$i." tr td.".$day.'t'.$newT."'";
											       			echo ("$($selector1).remove();");	// remove extra cells to give way to rowspan
											       		}

											       		$day = strtok("/");
											       }
												}

									 		?>
									 	});
									<?php $sectionCounter++; ?>
									@endwhile
									</script>
                                </div>
                            </div>
                        </div>
                    @endfor
                        
                    </div>
                </div>
@endsection