@extends('iteach.admin.dash-admin')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Upload CSV File <small>Admin {{ Auth::user()->username }} </small>
            </h1>
        </div>
    </div>

 

    <div class="alert alert-danger" role="alert">
    	<h4>UPLOAD FAILED!</h4>
    	{{$data}} is not a .csv file. 
    </div>
     
    <br/>
      
    <a href="uploadCSVFile" class="btn btn-default">Upload Another File!</a>
   

@endsection    