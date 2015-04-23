<?php 

	use Illuminate\Support\Facades\Auth;
	use App\Instructor;

	$requestor = Instructor::select('fname', 'lname')
						->where('employeeId', $request['heading'])
						->get();

	$requestor = $requestor[0]->fname." ".$requestor[0]->lname;

	Session::forget('page');

?>

@extends('iteach.dashboard.fdash')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
               Swap Request <small> {{ Session::get('userInst')['fname'] }} </small>
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-fw fa-user"></i> {{$requestor}} requested to swap 'Subject' with you.

                    <br><br>

                    <div id="choices" style="width:110px;">
                            
                        <form method="GET" action="{{ url('/confirmSwapRequest') }}" style="float:left;">
                           <input type="hidden" name="key" value="{{ $request['key'] }}">
                           <input type="submit" value="Swap">
                        </form>

                        <form method="GET" action="{{ url('/denySwapRequest') }}" style="float:right;">
                           <input type="hidden" name="key" value="{{ $request['key'] }}">
                           <input type="submit" value="Deny">
                        </form>
                        
                    </div>

                </li>
            </ol>
        </div>
    </div>
@endsection