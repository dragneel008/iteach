<?php namespace App\Http\Controllers\ITEACH;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ITEACH\AdminController;
use App\Http\Controllers\ITEACH\FacultyController;
use DB;
use Illuminate\Http\Request;
use Auth;
use Input;
use Session;

class HomeController extends Controller {

	function home(){

		if(Auth::check()){	//If authentication is done, user is not guest
			
			//No views have been made yet for Home (admin, faculty, and guest)
			if(Auth::User()->type == 'admin'){	//uses the table attribute 'type' to check if admin or faculty
				$requests = AdminController::getRequests()['requests'];
				$Nrequests = AdminController::getRequests()['Nrequests'];
				return view('iteach.admin.adminHome', compact('requests', 'Nrequests'));
			}else{
				$requests = FacultyController::getRequests()['requests'];
				$Nrequests = FacultyController::getRequests()['Nrequests'];
				return view('iteach.dashboard.facultyhome', compact('requests', 'Nrequests'));
			}
		}	
		else
			return view('iteach.dashboard.guest-home');

	}

}
