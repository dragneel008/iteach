<?php namespace App\Http\Controllers\ITEACH;

/*****************************************************************************
	This controller is for functionalities belonging to the administrator side.
	This allows the approval of sent requests by the user and whatnot.
******************************************************************************/

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
use Input;
use App\AddCourseLogs;
use App\AddDissolveSectionLogs;

class AdminController extends Controller {
	public function index() {
		return view('iteach.admin.adminHome');
	}

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

	public function assignInstructor()
	{
		$section = Input::get('section');
		$instructor = Input::get('assignEmployee');

		Section::where('sid', '=', $section)->update(['employeeId' => $instructor]);
		

		$requests = $this->getRequests()['requests'];
		$Nrequests = $this->getRequests()['Nrequests'];

		return view('iteach.admin.successfulAssign', compact('requests', 'Nrequests'));

	}

	public function addSection() {
		$results = $this->getRequests();
		$requests = $results['requests'];
		$Nrequests = $results['Nrequests'];

		$courses = course::get();
		$instructors = instructor::get();
		$rooms = room::get();

		return view('iteach.admin.addSection', compact('requests', 'Nrequests', 'courses','instructors','rooms'));
	}		
		
	public function processAddSection(){
		if(Input::get('sectionNumber') == null && Input::get('courseNumber') == null && Input::get('employee') == null)			//if no input (manually entered /attempt_login) is placed, redirect to index
			return redirect()->intended('addSection');

		//gets the input from the user
		$courseNumber = Input::get('courseNumber');
		$token2 = explode(" - ", $courseNumber);	//gets only the course number and removes the title
		$sectionNumber = Input::get('sectionNumber');

		//checks if the section to be added already exists
		$sections = section::where('sectionNum', '=', $sectionNumber)->where('courseNum', '=', $courseNumber)->get();

		if(count($sections)>0){
			return 'Error: Section of this course already exists!';	//TODO: UI for error
		}

		$employee = Input::get('employee');
		$room = Input::get('room');
		$classSize = Input::get('classSize');
		$time_slot = Input::get('time');
		$token = explode(" - ", $time_slot);

		$lectday1 = Input::get('lectureDay1');
		$lectday2 = Input::get('lectureDay2');		
		$day = $lectday1.'/'.$lectday2;

		//adds the section in the database
		section::create([ 'sectionNum' => $sectionNumber, 'courseNum' => $token2[0], 'startTime' => $token[0], 'endTime' => $token[1], 'day' => 	$day, 'roomNum' => $room, 'classSize' => $classSize,'employeeId' => $employee]);
		$logId = 'ADS'.count(adddissolvesectionlogs::all());	//generates the log id
		adddissolvesectionlogs::create(['logId' => $logId, 'courseNum' => $courseNumber,'sectionNum' => $sectionNumber, 'adminNum' => Auth::user()->employeeId, 'action'=>'add']);	//adds the log in the database
			
		return redirect()->intended('addSection');
	}

	public function addCourse() 
	{		
		$requests = $this->getRequests()['requests'];
		$Nrequests = $this->getRequests()['Nrequests'];
		$instructors = instructor::all();
		$courses = course::all();
		$rooms = room::all();
		return view('iteach.admin.addCourse', compact('requests', 'Nrequests', 'instructors', 'courses', 'rooms'));
	}

	public function processAddCourse(){
		if(Input::get('inputCourseNumber') == null)			//if no input (manually entered /attempt_login) is placed, redirect to index
			return redirect()->intended('addCourse');

		//gets the input from the user
		$courseNumber = Input::get('inputCourseNumber');
		$token2 = explode(" - ", $courseNumber);	//gets only the course number and removes the title
		$sectionNumber = Input::get('sectionNumber');

		//checks if the section to be added already exists
		$sections = section::where('sectionNum', '=', $sectionNumber)->where('courseNum', '=', $courseNumber)->get();

		if(count($sections)>0){
			return 'Error: Section of this course already exists!';	//TODO: UI for error
		}

		$employee = Input::get('employee');
		$room = Input::get('room');
		$classSize = Input::get('classSize');
		$time_slot = Input::get('time');
		$token = explode(" - ", $time_slot);

		$lectday1 = Input::get('lectureDay1');
		$lectday2 = Input::get('lectureDay2');		
		$day = $lectday1.'/'.$lectday2;

		//adds the course in the database
		section::create([ 'sectionNum' => $sectionNumber, 'courseNum' => $token2[0], 'startTime' => $token[0], 'endTime' => $token[1], 'day' => 	$day, 'roomNum' => $room, 'classSize' => $classSize,'employeeId' => $employee]);
		$logId = 'ADS'.count(AddDissolveSectionLogs::all());	//generates log id
		adddissolvesectionlogs::create(['logId' => $logId, 'courseNum' => $courseNumber,'sectionNum' => $sectionNumber, 'adminNum' => Auth::user()->employeeId, 'action'=>'add']);	//adds the log in the database
		//TODO: print successful

		return redirect()->intended('addCourse');
	}

	public function dissolveSection() {
		$requests = PendingRequest::getRequests('admin');
		$dissolve = course::get();
		$section = section::get();

		return view('iteach.admin.dissolveSection', compact('requests', 'dissolve', 'section'));
	}

	public function processDissolveSection() 
	{
		$courseNum = Input::get('courseNum');
		$sectionNum = Input::get('sectionNum');
		//deletes the section from the database
		$data = section::where('courseNum', '=', $courseNum)->where('sectionNum', '=', $sectionNum)->delete();//multiple
		if(count($data) > 0){
			$logId = 'ADS'.count(adddissolvesectionlogs::all());
			adddissolvesectionlogs::create(['logId' => $logId, 'courseNum' => $courseNum,'sectionNum' => $sectionNum, 'adminNum' => Auth::user()->employeeId, 'action'=>'dissolve']);	//adds the log in the database
		}
		return redirect()->intended('dissolveSection');
		
	}

	public function addSwapDissolveSection() {
		
		$requests = $this->getRequests()['requests'];
		$Nrequests = $this->getRequests()['Nrequests'];
		return view('iteach.admin.addSwapDissolveSection', compact('requests', 'Nrequests'));

	}

	public function swapSection() {
		$rows = Room::get();
		$courses = Course::get();

		$results = $this->getRequests();
		$requests = $results['requests'];
		$Nrequests = $results['Nrequests'];

		return view('iteach.admin.swapSection', compact('requests', 'Nrequests', 'rows', 'courses'));
	}


	public function editMinorDetailsFaculty() {
		$requests = PendingRequest::getRequests('admin');
		return view('iteach.admin.editMinorDetailsFaculty', compact('requests'));
	}

	public function editMinorDetailsRoom() {
		$results = $this->getRequests();
		$requests = $results['requests'];
		$Nrequests = $results['Nrequests'];
		$rooms = Room::get();

		return view('iteach.admin.editMinorDetailsRoom', compact('requests', 'Nrequests', 'rooms'));
	}
	

	public function getRoom() {
		$results = $this->getRequests();
		$requests = $results['requests'];
		$Nrequests = $results['Nrequests'];

		$roomNumber =  Input::get('roomNumber');

		$results = Room::where('roomNum','=',$roomNumber)->get();

		if(count($results) == 0){
			return view('iteach.admin.editMinorDetailsRoom', 'requests', 'Nrequests');
		}
		else {
			$roomCapacity = $results[0]->capacity;
			$room = array($roomNumber, $roomCapacity);
			return view('iteach.admin.editRoomCapacity', compact('room', 'requests', 'Nrequests'));
		}

	}

	public function editRoomCapacity() {
		$results = $this->getRequests();
		$requests = $results['requests'];
		$Nrequests = $results['Nrequests'];

		$rooms = Room::get();
		
		$roomCapacity = Input::get('roomCapacity');
		$roomNumber = Input::get('roomNumber');
		
		Room::where('roomNum',"=",$roomNumber)->update(array("capacity"=>$roomCapacity));
		
		return view('iteach.admin.editMinorDetailsRoom', compact('requests', 'Nrequests', 'rooms'));
	}

	public function getFaculty() {

		$employeeNumber = Input::get('employeeNumber');

		$results = instructor::where('employeeNum','=',$employeeNumber)->get();
		if(count($results) == 0){
			return view('iteach.admin.editMinorDetailsFaculty', 'requests');
		}
		else {
			//this assumes that the number of students enrolled in a section
			//is equal to the capacity of the room of that section

			$teachingLoad = 0;
			$sectionsTaught = section::where('employeeNum','=',$employeeNumber)->get();
			
			foreach($sectionssTaught as $section){
				$room = room::where('roomNum','=',$section->courseNum)[0];
				
				if($section->type == 'thesis'){
					$load = 0;
				}
				else if($section->type == 'uglect' || $section->type == 'sp'){
					$n = $section->capacity;
					$temp = ((1+((n-40)/120))*2);
					if($temp > 2){
						$load = $temp; 
					}
					else{
						$load = 2;
					}
				}
				else if($selection->type == 'uglab'){
					$load = 1.5;
				}
				else if($selection->type == 'glect'){
					$load = 4.5;
				}
				else if($selection->type == 'glectwlab'){
					$load = 3;
				}
				else if($selection->type == 'glab'){
					$load = 2.25;
				}

				$teachingLoad += $load;
			}

			return view('iteach.admin.editFacultyLoad', compact('teachingLoad', 'requests'));
		}

		/*
		UG lect and sp
		MAX(2, ((1+((n-40)/120))*2))
		where n = number of students

		UG lab: 1.5
		UG thesis: 0

		G lect only: 4.5
		G lect w/ lab: 3
		G lab: 2.25
		G thesis: 0
		*/
	}

	public function viewAllRequests() {
		
		$requests = $this->getRequests()['requests'];
		$Nrequests = $this->getRequests()['Nrequests'];
		return view('iteach.admin.viewAllRequests', compact('requests', 'Nrequests'));
	}

	public function approveRequest(Request $request) {
		// Okay na to! - Gani
		// Since may reference na ako sa rid pwede ko ng iupdate yung status nito sa database
		$rid = $request->input('rid');
		return $rid;
	}

	public function viewSystemLog()
	{
		$requests = $this->getRequests()['requests'];
		$Nrequests = $this->getRequests()['Nrequests'];
		$addCourse = addcourselogs::all();
		$addDissolveSection = adddissolvesectionlogs::all();

		return view('iteach.admin.viewSystemLog', compact('requests', 'Nrequests', 'addCourse', 'addDissolveSection'));
	}
	

}
