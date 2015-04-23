<?php namespace App\Http\Controllers\ITEACH;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ITEACH\AdminController;
use App\Http\Controllers\ITEACH\FacultyController;
use Auth;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Instructor;
use App\Room;
use App\Course;
use App\Section;
use App\CourseTimeSlot;
use App\StudyTimeSlot;

class ViewController extends Controller {

	function viewAll(){
		$sections['sections'] = section::join('courses', 'sections.courseNum', '=', 'courses.courseNum')
			->join('instructors', 'sections.employeeId', '=', 'instructors.employeeId')
			->orderBy('courses.courseNum','ASC')
			->orderBy('sections.sectionNum','ASC')
			->get();

		$instructors['instructors'] = instructor::all();

		if(Auth::check()){	//If authentication is done, user is not guest
			
			Session::forget('page');
			Session::put('page', 'viewAll');

			//No views have been made yet for Home (admin, faculty, and guest)
			if(Auth::User()->type == 'admin'){
				//uses the table attribute 'type' to check if admin or faculty
				
				$requests = AdminController::getRequests()['requests'];
				$Nrequests = AdminController::getRequests()['Nrequests'];
				return view('iteach.dashboard.aviewAll', compact('requests', 'Nrequests', 'sections', 'instructors'));
			}	
			else{

				$requests = FacultyController::getRequests()['requests'];
				$Nrequests = FacultyController::getRequests()['Nrequests'];
				return view('iteach.dashboard.fviewAll', compact('requests', 'Nrequests', 'sections'));
			}
		}
		else{
			return view('iteach.dashboard.gviewAll', $sections);
		}
	}
	function viewCourse(){
		if(Auth::check())	//If authentication is done, user is not guest
			
			//No views have been made yet for Home (admin, faculty, and guest)
			if(Auth::User()->type == 'admin')	//uses the table attribute 'type' to check if admin or faculty
				return "logged in as admin";
			else
				return "logged in as faculty";
			
		else{
			$sections['sections'] = section::join('courses', 'sections.courseNum', '=', 'courses.courseNum')
											->join('instructors', 'sections.employeeId', '=', 'instructors.employeeId')
											->get();
			$courses['courses'] = course::all();
			return view('iteach.dashboard.viewCourse', $sections, $courses);
		}
	}
	function viewInstructor(){
		$allInstructors['allInstructors'] = instructor::orderBy('lname','ASC')
			->where('status', 'Active')
			->get();
		$instructors['instructors'] = instructor::join('sections', 'instructors.employeeId', '=', 'sections.employeeId')
	      ->join('courses', 'sections.courseNum', '=', 'courses.courseNum')
	      ->orderBy('lname','ASC')
	      ->orderBy('courses.courseNum','ASC')
	      ->orderBy('sections.sectionNum','ASC')
	      ->get();
		
		if(Auth::check()){	//If authentication is done, user is not guest
			
			Session::forget('page');
			Session::put('page', 'viewInstructor');

			//No views have been made yet for Home (admin, faculty, and guest)
			if(Auth::User()->type == 'admin'){	//uses the table attribute 'type' to check if admin or faculty
				$requests = AdminController::getRequests()['requests'];
				$Nrequests = AdminController::getRequests()['Nrequests'];
				return view('iteach.dashboard.aviewInstructor', compact('requests', 'Nrequests', 'instructors', 'allInstructors'));
			}else{
				$requests = FacultyController::getRequests()['requests'];
				$Nrequests = FacultyController::getRequests()['Nrequests'];
				return view('iteach.dashboard.fviewInstructor', compact('requests', 'Nrequests', 'instructors', 'allInstructors'));
			}
		}	
		else{
			return view('iteach.dashboard.gviewInstructor', $instructors, $allInstructors);
		}
	}
	function viewRoom(){

		if(Auth::check()){	//If authentication is done, user is not guest
			
			//No views have been made yet for Home (admin, faculty, and guest)
			if(Auth::User()->type == 'admin')	//uses the table attribute 'type' to check if admin or faculty
				return "logged in as admin";
			else
				return "logged in as faculty";
		}
		else{
			$rooms['rooms'] = room::orderBy('roomNum','ASC')
									->get();
			$sections['sections'] = section::orderBy('roomNum','ASC')
											->get();
			$instructors['instructors'] = instructor::all();
			return view('iteach.dashboard.viewRoom', $rooms, $sections, $instructors);
		}
	}
}
