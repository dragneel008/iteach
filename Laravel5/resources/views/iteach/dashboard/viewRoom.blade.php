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

                    @for ($i = 0;$i<count($rooms); $i++)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion{{$i}}" href="#collapse{{$i}}">{{$rooms[$i]->roomNum}}</a>
                                </h4>
                            </div>
                            <div id="collapse{{$i}}" class="panel-collapse collapse">
                                <div class="panel-body">
									<table class="tg">
									  <tr>
									    <th class="tg-vx3v" colspan="6">{{$rooms[$i]->roomNum}}</th>
									  </tr>

									  	<?php $cnt=0; $m=12; $tu=12; $w=12; $th=12; $f=12; ?>
										@for($a=0;$a!=count($sections);$a++)
											@if($sections[$a]->roomNum == $rooms[$i]->roomNum)
												<?php $arr[$cnt] = $a; $cnt++; ?>
											@endif
										@endfor

									  <tr>
									    <td class="tg-7l82">Time / Day</td>
									    <td class="tg-7l82">Monday</td>
									    <td class="tg-7l82">Tuesday</td>
									    <td class="tg-7l82">Wednesday</td>
									    <td class="tg-7l82">Thursday</td>
									    <td class="tg-7l82">Friday</td>
									  </tr>
									  <tr>
									    <td class="tg-jecd">7:00 - 8:00</td>
										<?php $st = "7:00"; $ed = "8:00"; ?>
										@for($a=0;$a!=$cnt;$a++)
											@if($sections[$arr[$a]]->startTime == $st)
												<?php
													$sectString = "{{$sections[$arr[$a]]->day}}";
													if($sectString != "TBA"){
														$tkn = substr($sectString, 2, 1);
														if ($tkn!="H"){
															$tkn = substr($sectString, 1, 1);
														}
														$tkn2 = substr($sectString, -2, 1);

														if ($sections[$arr[$a]]->startTime != "TBA" || $sections[$arr[$a]]->endTime != "TBA"){
															$start = $sections[$arr[$a]]->startTime - ":00";
															$end = $sections[$arr[$a]]->endTime - ":00";
															if ($end-$start == 1 || $end-$start == -11){
																$row = 1;
															}elseif ($end-$start == 2 || $end-$start == -10){
																$row = 2;
															}else{
																$row = 3;
															}
														}
													}
												?>
												@if($tkn == $tkn2)
													@if($tkn=="M")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="T")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="W")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="H")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@else
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@endif
												@else
													@if($tkn=="M" || $tkn2=="M")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="T" || $tkn2=="T")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="W" || $tkn2=="W")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="H" || $tkn2=="H")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@else
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@endif
												@endif
											@endif
										@endfor
									  </tr>
									  <tr>
									    <td class="tg-jecd">8:00 - 9:00</td>
										<?php $st = "8:00"; $ed = "9:00"; ?>
										@for($a=0;$a!=$cnt;$a++)
											@if($sections[$arr[$a]]->startTime == $st)
												<?php
													$sectString = "{{$sections[$arr[$a]]->day}}";
													if($sectString != "TBA"){
														$tkn = substr($sectString, 2, 1);
														if ($tkn!="H"){
															$tkn = substr($sectString, 1, 1);
														}
														$tkn2 = substr($sectString, -2, 1);

														if ($sections[$arr[$a]]->startTime != "TBA" || $sections[$arr[$a]]->endTime != "TBA"){
															$start = $sections[$arr[$a]]->startTime - ":00";
															$end = $sections[$arr[$a]]->endTime - ":00";
															if ($end-$start == 1 || $end-$start == -11){
																$row = 1;
															}elseif ($end-$start == 2 || $end-$start == -10){
																$row = 2;
															}else{
																$row = 3;
															}
														}
													}
												?>
												@if($tkn == $tkn2)
													@if($tkn=="M")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="T")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="W")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="H")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@else
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@endif
												@else
													@if($tkn=="M" || $tkn2=="M")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="T" || $tkn2=="T")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="W" || $tkn2=="W")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="H" || $tkn2=="H")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@else
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@endif
												@endif
											@endif
										@endfor
									  </tr>
									  <tr>
									    <td class="tg-jecd">9:00 - 10:00</td>
										<?php $st = "9:00"; $ed = "10:00"; ?>
										@for($a=0;$a!=$cnt;$a++)
											@if($sections[$arr[$a]]->startTime == $st)
												<?php
													$sectString = "{{$sections[$arr[$a]]->day}}";
													if($sectString != "TBA"){
														$tkn = substr($sectString, 2, 1);
														if ($tkn!="H"){
															$tkn = substr($sectString, 1, 1);
														}
														$tkn2 = substr($sectString, -2, 1);

														if ($sections[$arr[$a]]->startTime != "TBA" || $sections[$arr[$a]]->endTime != "TBA"){
															$start = $sections[$arr[$a]]->startTime - ":00";
															$end = $sections[$arr[$a]]->endTime - ":00";
															if ($end-$start == 1 || $end-$start == -11){
																$row = 1;
															}elseif ($end-$start == 2 || $end-$start == -10){
																$row = 2;
															}else{
																$row = 3;
															}
														}
													}
												?>
												@if($tkn == $tkn2)
													@if($tkn=="M")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="T")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="W")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="H")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@else
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@endif
												@else
													@if($tkn=="M" || $tkn2=="M")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="T" || $tkn2=="T")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="W" || $tkn2=="W")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="H" || $tkn2=="H")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@else
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@endif
												@endif
											@endif
										@endfor
									  </tr>
									  <tr>
									    <td class="tg-jecd">10:00 - 11:00</td>
										<?php $st = "10:00"; $ed = "11:00"; ?>
										@for($a=0;$a!=$cnt;$a++)
											@if($sections[$arr[$a]]->startTime == $st)
												<?php
													$sectString = "{{$sections[$arr[$a]]->day}}";
													if($sectString != "TBA"){
														$tkn = substr($sectString, 2, 1);
														if ($tkn!="H"){
															$tkn = substr($sectString, 1, 1);
														}
														$tkn2 = substr($sectString, -2, 1);

														if ($sections[$arr[$a]]->startTime != "TBA" || $sections[$arr[$a]]->endTime != "TBA"){
															$start = $sections[$arr[$a]]->startTime - ":00";
															$end = $sections[$arr[$a]]->endTime - ":00";
															if ($end-$start == 1 || $end-$start == -11){
																$row = 1;
															}elseif ($end-$start == 2 || $end-$start == -10){
																$row = 2;
															}else{
																$row = 3;
															}
														}
													}
												?>
												@if($tkn == $tkn2)
													@if($tkn=="M")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="T")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="W")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="H")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@else
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@endif
												@else
													@if($tkn=="M" || $tkn2=="M")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="T" || $tkn2=="T")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="W" || $tkn2=="W")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="H" || $tkn2=="H")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@else
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@endif
												@endif
											@endif
										@endfor
									  </tr>
									  <tr>
									    <td class="tg-jecd">11:00 - 12:00</td>
										<?php $st = "11:00"; $ed = "12:00"; ?>
										@for($a=0;$a!=$cnt;$a++)
											@if($sections[$arr[$a]]->startTime == $st)
												<?php
													$sectString = "{{$sections[$arr[$a]]->day}}";
													if($sectString != "TBA"){
														$tkn = substr($sectString, 2, 1);
														if ($tkn!="H"){
															$tkn = substr($sectString, 1, 1);
														}
														$tkn2 = substr($sectString, -2, 1);

														if ($sections[$arr[$a]]->startTime != "TBA" || $sections[$arr[$a]]->endTime != "TBA"){
															$start = $sections[$arr[$a]]->startTime - ":00";
															$end = $sections[$arr[$a]]->endTime - ":00";
															if ($end-$start == 1 || $end-$start == -11){
																$row = 1;
															}elseif ($end-$start == 2 || $end-$start == -10){
																$row = 2;
															}else{
																$row = 3;
															}
														}
													}
												?>
												@if($tkn == $tkn2)
													@if($tkn=="M")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="T")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="W")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="H")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@else
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@endif
												@else
													@if($tkn=="M" || $tkn2=="M")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="T" || $tkn2=="T")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="W" || $tkn2=="W")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="H" || $tkn2=="H")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@else
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@endif
												@endif
											@endif
										@endfor
									  </tr>
									  <tr>
									    <td class="tg-jecd">12:00 - 1:00</td>
										<?php $st = "12:00"; $ed = "1:00";  ?>
										@for($a=0;$a!=$cnt;$a++)
											@if($sections[$arr[$a]]->startTime == $st)
												<?php
													$sectString = "{{$sections[$arr[$a]]->day}}";
													if($sectString != "TBA"){
														$tkn = substr($sectString, 2, 1);
														if ($tkn!="H"){
															$tkn = substr($sectString, 1, 1);
														}
														$tkn2 = substr($sectString, -2, 1);

														if ($sections[$arr[$a]]->startTime != "TBA" || $sections[$arr[$a]]->endTime != "TBA"){
															$start = $sections[$arr[$a]]->startTime - ":00";
															$end = $sections[$arr[$a]]->endTime - ":00";
															if ($end-$start == 1 || $end-$start == -11){
																$row = 1;
															}elseif ($end-$start == 2 || $end-$start == -10){
																$row = 2;
															}else{
																$row = 3;
															}
														}
													}
												?>
												@if($tkn == $tkn2)
													@if($tkn=="M")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="T")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="W")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="H")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@else
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@endif
												@else
													@if($tkn=="M" || $tkn2=="M")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="T" || $tkn2=="T")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="W" || $tkn2=="W")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="H" || $tkn2=="H")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@else
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@endif
												@endif
											@endif
										@endfor
									  </tr>
									  <tr>
									    <td class="tg-jecd">1:00 - 2:00</td>
										<?php $st = "1:00"; $ed = "2:00"; ?>
										@for($a=0;$a!=$cnt;$a++)
											@if($sections[$arr[$a]]->startTime == $st)
												<?php
													$sectString = "{{$sections[$arr[$a]]->day}}";
													if($sectString != "TBA"){
														$tkn = substr($sectString, 2, 1);
														if ($tkn!="H"){
															$tkn = substr($sectString, 1, 1);
														}
														$tkn2 = substr($sectString, -2, 1);

														if ($sections[$arr[$a]]->startTime != "TBA" || $sections[$arr[$a]]->endTime != "TBA"){
															$start = $sections[$arr[$a]]->startTime - ":00";
															$end = $sections[$arr[$a]]->endTime - ":00";
															if ($end-$start == 1 || $end-$start == -11){
																$row = 1;
															}elseif ($end-$start == 2 || $end-$start == -10){
																$row = 2;
															}else{
																$row = 3;
															}
														}
													}
												?>
												@if($tkn == $tkn2)
													@if($tkn=="M")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="T")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="W")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="H")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@else
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@endif
												@else
													@if($tkn=="M" || $tkn2=="M")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="T" || $tkn2=="T")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="W" || $tkn2=="W")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="H" || $tkn2=="H")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@else
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@endif
												@endif
											@endif
										@endfor
									  </tr>
									  <tr>
									    <td class="tg-jecd">2:00 - 3:00</td>
										<?php $st = "2:00"; $ed = "3:00"; ?>
										@for($a=0;$a!=$cnt;$a++)
											@if($sections[$arr[$a]]->startTime == $st)
												<?php
													$sectString = "{{$sections[$arr[$a]]->day}}";
													if($sectString != "TBA"){
														$tkn = substr($sectString, 2, 1);
														if ($tkn!="H"){
															$tkn = substr($sectString, 1, 1);
														}
														$tkn2 = substr($sectString, -2, 1);

														if ($sections[$arr[$a]]->startTime != "TBA" || $sections[$arr[$a]]->endTime != "TBA"){
															$start = $sections[$arr[$a]]->startTime - ":00";
															$end = $sections[$arr[$a]]->endTime - ":00";
															if ($end-$start == 1 || $end-$start == -11){
																$row = 1;
															}elseif ($end-$start == 2 || $end-$start == -10){
																$row = 2;
															}else{
																$row = 3;
															}
														}
													}
												?>
												@if($tkn == $tkn2)
													@if($tkn=="M")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="T")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="W")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="H")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@else
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@endif
												@else
													@if($tkn=="M" || $tkn2=="M")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="T" || $tkn2=="T")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="W" || $tkn2=="W")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="H" || $tkn2=="H")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@else
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@endif
												@endif
											@endif
										@endfor
									  </tr>
									  <tr>
									    <td class="tg-jecd">3:00 - 4:00</td>
										<?php $st = "3:00"; $ed = "4:00"; ?>
										@for($a=0;$a!=$cnt;$a++)
											@if($sections[$arr[$a]]->startTime == $st)
												<?php
													$sectString = "{{$sections[$arr[$a]]->day}}";
													if($sectString != "TBA"){
														$tkn = substr($sectString, 2, 1);
														if ($tkn!="H"){
															$tkn = substr($sectString, 1, 1);
														}
														$tkn2 = substr($sectString, -2, 1);

														if ($sections[$arr[$a]]->startTime != "TBA" || $sections[$arr[$a]]->endTime != "TBA"){
															$start = $sections[$arr[$a]]->startTime - ":00";
															$end = $sections[$arr[$a]]->endTime - ":00";
															if ($end-$start == 1 || $end-$start == -11){
																$row = 1;
															}elseif ($end-$start == 2 || $end-$start == -10){
																$row = 2;
															}else{
																$row = 3;
															}
														}
													}
												?>
												@if($tkn == $tkn2)
													@if($tkn=="M")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="T")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="W")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="H")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@else
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@endif
												@else
													@if($tkn=="M" || $tkn2=="M")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="T" || $tkn2=="T")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="W" || $tkn2=="W")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="H" || $tkn2=="H")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@else
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@endif
												@endif
											@endif
										@endfor
									  </tr>
									  <tr>
									    <td class="tg-jecd">4:00 - 5:00</td>
										<?php $st = "4:00"; $ed = "5:00"; ?>
										@for($a=0;$a!=$cnt;$a++)
											@if($sections[$arr[$a]]->startTime == $st)
												<?php
													$sectString = "{{$sections[$arr[$a]]->day}}";
													if($sectString != "TBA"){
														$tkn = substr($sectString, 2, 1);
														if ($tkn!="H"){
															$tkn = substr($sectString, 1, 1);
														}
														$tkn2 = substr($sectString, -2, 1);

														if ($sections[$arr[$a]]->startTime != "TBA" || $sections[$arr[$a]]->endTime != "TBA"){
															$start = $sections[$arr[$a]]->startTime - ":00";
															$end = $sections[$arr[$a]]->endTime - ":00";
															if ($end-$start == 1 || $end-$start == -11){
																$row = 1;
															}elseif ($end-$start == 2 || $end-$start == -10){
																$row = 2;
															}else{
																$row = 3;
															}
														}
													}
												?>
												@if($tkn == $tkn2)
													@if($tkn=="M")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="T")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="W")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="H")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@else
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@endif
												@else
													@if($tkn=="M" || $tkn2=="M")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="T" || $tkn2=="T")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="W" || $tkn2=="W")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="H" || $tkn2=="H")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@else
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@endif
												@endif
											@endif
										@endfor
									  </tr>
									  <tr>
									    <td class="tg-jecd">5:00 - 6:00</td>
										<?php $st = "5:00"; $ed = "6:00"; ?>
										@for($a=0;$a!=$cnt;$a++)
											@if($sections[$arr[$a]]->startTime == $st)
												<?php
													$sectString = "{{$sections[$arr[$a]]->day}}";
													if($sectString != "TBA"){
														$tkn = substr($sectString, 2, 1);
														if ($tkn!="H"){
															$tkn = substr($sectString, 1, 1);
														}
														$tkn2 = substr($sectString, -2, 1);

														if ($sections[$arr[$a]]->startTime != "TBA" || $sections[$arr[$a]]->endTime != "TBA"){
															$start = $sections[$arr[$a]]->startTime - ":00";
															$end = $sections[$arr[$a]]->endTime - ":00";
															if ($end-$start == 1 || $end-$start == -11){
																$row = 1;
															}elseif ($end-$start == 2 || $end-$start == -10){
																$row = 2;
															}else{
																$row = 3;
															}
														}
													}
												?>
												@if($tkn == $tkn2)
													@if($tkn=="M")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="T")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="W")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="H")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@else
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@endif
												@else
													@if($tkn=="M" || $tkn2=="M")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="T" || $tkn2=="T")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="W" || $tkn2=="W")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="H" || $tkn2=="H")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@else
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@endif
												@endif
											@endif
										@endfor
									  </tr>
									  <tr>
									    <td class="tg-jecd">6:00 - 7:00</td>
										<?php $st = "6:00"; $ed = "7:00"; ?>
										@for($a=0;$a!=$cnt;$a++)
											@if($sections[$arr[$a]]->startTime == $st)
												<?php
													$sectString = "{{$sections[$arr[$a]]->day}}";
													if($sectString != "TBA"){
														$tkn = substr($sectString, 2, 1);
														if ($tkn!="H"){
															$tkn = substr($sectString, 1, 1);
														}
														$tkn2 = substr($sectString, -2, 1);

														if ($sections[$arr[$a]]->startTime != "TBA" || $sections[$arr[$a]]->endTime != "TBA"){
															$start = $sections[$arr[$a]]->startTime - ":00";
															$end = $sections[$arr[$a]]->endTime - ":00";
															if ($end-$start == 1 || $end-$start == -11){
																$row = 1;
															}elseif ($end-$start == 2 || $end-$start == -10){
																$row = 2;
															}else{
																$row = 3;
															}
														}
													}
												?>
												@if($tkn == $tkn2)
													@if($tkn=="M")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="T")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="W")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="H")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@else
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@endif
												@else
													@if($tkn=="M" || $tkn2=="M")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="T" || $tkn2=="T")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="W" || $tkn2=="W")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@elseif($tkn=="H" || $tkn2=="H")
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@else
														<td class="tg-031e" rowspan={{$row}}> {{$sections[$arr[$a]]->courseNum}} - {{$sections[$arr[$a]]->sectionNum}} </td>
													@endif
												@endif
											@endif
										@endfor
									  </tr>
									</table>
                                </div>
                            </div>
                        </div>
                    @endfor
                        
                    </div>
                </div>
@endsection