<?php 

	use Illuminate\Support\Facades\Auth;
	use App\Instructor;
	use App\Swap;
	use Illuminate\Support\Facades\Session;

	$sRequests = Swap::join('requests', 'requests.key', '=', 'swaps.rkey')
		->where('swaps.owner', Session::get('userInst')['employeeId'])
		->where('requests.processed', false)
		->get();
		
	Session::forget('page');
	Session::put('page', 'viewSwapRequests');

?>

@extends('iteach.dashboard.fdash')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
               All Swap Requests <small> {{ Session::get('userInst')['fname'] }} </small>
            </h1>
            @foreach($sRequests as $r)
            <ol class="breadcrumb">
                <li class="active">
                    	<i class="fa fa-fw fa-user"></i> <?php echo Instructor::where('employeeId', $r->requestor)->get()[0]->fname ?> requested to swap {{$r->sectionNum}} with you.

                    	<br><br>

                    	<div id="choices" style="width:110px;">
								
								<form method="GET" action="{{ url('/confirmSwapRequest') }}" style="float:left;">
								   <input type="hidden" name="key" value="{{ $r->rkey }}">
								   <input type="submit" value="Swap">
								</form>

								<form method="GET" action="{{ url('/denySwapRequest') }}" style="float:right;">
								   <input type="hidden" name="key" value="{{ $r->rkey }}">
								   <input type="submit" value="Deny">
								</form>

							</div>

                </li>
            </ol>
            @endforeach
        </div>
    </div>
@endsection