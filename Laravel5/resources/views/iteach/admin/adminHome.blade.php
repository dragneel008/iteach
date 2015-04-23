@extends('iteach.admin.dash-admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Welcome <small>Admin {{ Session::get('userInst')['fname'] }} </small>
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-home"></i> Home
                </li>
            </ol>
        </div>
    </div>
@endsection    

