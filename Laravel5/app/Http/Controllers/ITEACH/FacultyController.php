<?php namespace App\Http\Controllers\ITEACH;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Session;
use Auth;

use App\PendingRequest;
use App\course;
use App\instructor;
use App\room;
use App\section;
use DB;

class FacultyController extends Controller {

   public static function getRequests(){

      $tuple = DB::table('requests')
         ->orderBy('created_at', 'desc')
         ->where('recipient', Session::get('userInst')['employeeId'])
         ->orWhere('recipient', '')
         ->get();

      $requests = [];
      $Nrequests = [];
      foreach($tuple as $t){

         if(empty($t->heading)){
            $req = ['request'=>$t, 'heading'=>'Administrator'];
         }
         else{
            $temp = DB::table('instructors')->where('employeeId', $t->heading)->get();
            $req = ['request'=>$t, 'heading'=>$temp[0]->fname];
         }

         $requests = $tuple;

         array_push($Nrequests, $req);
     }
      return array('requests' => $requests, 'Nrequests' => $Nrequests);

   }

}
