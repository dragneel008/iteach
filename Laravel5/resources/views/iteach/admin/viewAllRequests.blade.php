<!-- 
    Author: Team Gani
    Date last modified: April 5, 2015
    Description:

 -->

@extends('iteach.admin.dash-admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                View All Requests <small>Admin {{ Auth::user()->username }} </small>
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <table class="table table-bordered">
                <th width="15%" class="text-center">Request ID</th>
                <th width="55%" class="text-center">Message</th>
                <th width="30%" class="text-center">Action</th>

                @if(count($requests))
                    @foreach ($requests as $req)
                        <tr class="text-center">
                            <td> {{ $req->rid }} </td>
                            <td> {{ $req->message }} </td> 
                            <td>
                                <button type="button" onclick="approveRequest({{ $req->rid }})" class="btn btn-default" aria-label="Approve">
                                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>           
                                </button>
                                <button type="button" class="btn btn-default" aria-label="Disapprove">
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>           
                                </button>
                            </td>   
                        </tr>
                    @endforeach
                @else
                    <tr class="text-center">
                        <td colspan="3"> NO REQUESTS AS OF THE MOMENT </td>
                    </tr>
                @endif

            </table>
        </div>
    </div>

    <script type="text/javascript">
        var token = "{!!  csrf_token()   !!}";  

        function approveRequest(rid) { 
            $.ajax({
                type    : "POST",
                url     : "approveRequest",
                data    : {'rid' : rid, '_token' : token},
                success : function(result) {
                            alert(result);
                            alert("AJAX IS SUCCESSFUL!");
                          }
            });
        }

        function disapproveRequest() {

        }
    </script>
@endsection    

