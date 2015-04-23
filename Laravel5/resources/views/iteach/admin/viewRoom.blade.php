@extends('iteach.admin.dash-admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
              	View Room <small>Admin {{ Auth::user()->username }}</small>
            </h1>
            	@foreach( $rows as $data)
					{{$data->roomNum}}
				@endforeach
            	
        </div>
    </div>
@endsection

