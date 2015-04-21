<?php namespace App\Http\Controllers\ITEACH;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use DB;
use App\Instructor;
use App\room;
use App\course;
use App\section;
use App\courseTimeSlot;
use App\studyTimeSlot;

class ViewController extends Controller {

	function viewAll(){
		if(Auth::check())	//If authentication is done, user is not guest
			
			//No views have been made yet for Home (admin, faculty, and guest)
			if(Auth::User()->type == 'admin')	//uses the table attribute 'type' to check if admin or faculty
				return "logged in as admin";
			else
				return "logged in as faculty";
			
		else{
			$sections['sections'] = section::join('courses', 'sections.courseNum', '=', 'courses.courseNum')
											->join('instructors', 'sections.employeeId', '=', 'instructors.employeeId')
											->orderBy('courses.courseNum','ASC')
											->orderBy('sections.sectionNum','ASC')
											->get();
			return view('iteach.dashboard.viewAll', $sections);
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
											->orderBy('courses.courseNum','ASC')
											->orderBy('sections.sectionNum','ASC')
											->get();
			$courses['courses'] = course::all();
			return view('iteach.dashboard.viewCourse', $sections, $courses);
		}
	}
	function viewInstructor(){
		if(Auth::check())	//If authentication is done, user is not guest
			
			//No views have been made yet for Home (admin, faculty, and guest)
			if(Auth::User()->type == 'admin')	//uses the table attribute 'type' to check if admin or faculty
				return "logged in as admin";
			else
				return "logged in as faculty";
			
		else{
			$allInstructors['allInstructors'] = instructor::orderBy('lname','ASC')
											->where('instructors.status','active')
											->get();
			$instructors['instructors'] = instructor::join('sections', 'instructors.employeeId', '=', 'sections.employeeId')
								      ->join('courses', 'sections.courseNum', '=', 'courses.courseNum')
								      ->orderBy('lname','ASC')
								      ->orderBy('courses.courseNum','ASC')
								      ->orderBy('sections.sectionNum','ASC')
								      ->get();
			return view('iteach.dashboard.viewInstructor', $instructors, $allInstructors);
		}
	}
	function viewRoom(){

		if(Auth::check())	//If authentication is done, user is not guest
			
			//No views have been made yet for Home (admin, faculty, and guest)
			if(Auth::User()->type == 'admin')	//uses the table attribute 'type' to check if admin or faculty
				return "logged in as admin";
			else
				return "logged in as faculty";
			
		else{
			$rooms['rooms'] = room::all();
			$sections['sections'] = section::orderBy('startTime')
											->get();
			return view('iteach.dashboard.viewRoom', $rooms, $sections);
		}
	}
}
