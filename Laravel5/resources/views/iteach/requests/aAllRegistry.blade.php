<?php 

	use Illuminate\Support\Facades\Auth;
	use App\Instructor;
	use App\Swap;
	use App\User;
	use Illuminate\Support\Facades\Session;

	$rRequests = User::join('instructors', 'users.employeeId', '=', 'instructors.employeeId')
		->join('requests', 'requests.heading', '=', 'instructors.employeeId')
		->where('instructors.registered', false)
		->where('contentId', '00')
		->get();



	Session::forget('page');
	Session::put('page', 'viewRegistryRequests');

?>

@extends('iteach.admin.dash-admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
               All Registry Requests <small> {{ Session::get('userInst')['fname'] }} </small>
            </h1>
            @foreach($rRequests as $r)
            <ol class="breadcrumb">
                <li class="active">
                    	<i class="fa fa-fw fa-user"></i> <?php echo Instructor::where('employeeId', $r->heading)->get()[0]->fname ?> requested to be registered.

                    	<br><br>

                    	<div id="choices" style="width:130px;">
								
								<form method="GET" action="{{ url('/confirmRegistryRequest') }}" style="float:left;">
								   <input type="hidden" name="key" value="{{ $r->key }}">
								   <input type="submit" value="Register">
								</form>

								<form method="GET" action="{{ url('/denyRegistryRequest') }}" style="float:right;">
								   <input type="hidden" name="key" value="{{ $r->key }}">
								   <input type="submit" value="Deny">
								</form>

							</div>

                </li>
            </ol>
            @endforeach
        </div>
    </div>
@endsection