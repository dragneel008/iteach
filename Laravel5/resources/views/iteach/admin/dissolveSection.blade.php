@extends('iteach.admin.dash-admin')

@section('content')
    <!--
        TODO
            Delete Section Stuff
            What section stuff?
     -->

	 <div class="row">
	 	<div class="col-lg-12">
	 		<h1 class="page-header">
	 			Dissolve Section <small>Admin {{ Auth::user()->username }}</small>
	 		</h1>
	 	</div>
	 </div>

	 <div class="row">
	 	<form role="role" class="form-horizontal" method="post" action="#">
	        <div class="form-group">
	            <label for="inputCourseNumber" class="col-lg-2 control-label">Course Number</label>
	            <div class="col-lg-4">
					<select class="form-control">
					    <option value="null" selected></option>
					   	@foreach($dissolve as $diss)
                        	<option value="{{$diss->courseNum}}"> {{$diss->courseNum}} </option>    
						@endforeach
					</select>
	            </div>
	        </div>

	        <div class="form-group">
	            <label for="inputCourseSection" class="col-lg-2 control-label">Course Section</label>
	            <div class="col-lg-4">
					<select class="form-control">
					    <option value="null" selected></option>

					    <!-- 
							TODO
								Make this part dynamic based on the sections mapped to the course number.
								Error: Only the last appended course has its sections found.
					     -->
						@foreach($section as $q)
							@if($q->courseNum == $diss->courseNum)
                        		<option value="{{$q->sectionNum}}"> {{$q->sectionNum}}</option>

                        	@endif
						@endforeach
					   
					</select>
	            </div>
	        </div>

	        <div class="form-group">
	        	<div class="col-lg-offset-2 col-lg-4">
                	<button type="submit" class="btn btn-default">Submit</button>
                	<button type="reset" class="btn btn-default">Clear</button>
	        	</div>
	        </div>

	 	</form>
	 </div>
@endsection

