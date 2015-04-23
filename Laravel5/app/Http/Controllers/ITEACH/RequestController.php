<?php namespace App\Http\Controllers\ITEACH;

//use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ITEACH\AdminController;
use App\Http\Controllers\ITEACH\FacultyController;
use App\Request;
use App\instructor;
use Auth;
use Input;
use Session;
use App\Swap;
use App\Section;

class RequestController extends Controller {

	function processRedirect(){

		$request = Session::get('request');
		
		//Samples for contentId manipulation
		switch($request->contentId){
			
			case '00':	return redirect('viewRegistryRequests');	//not realistic implementation
			case '01':	return $this->swap();	//contentId 01 == swap
		
		}

	}

	function viewAllSwaps(){

		if(Auth::User()->type == 'admin'){
			return AdminController::augment('iteach.requests.aAllSwap');
		}
		else{
			return FacultyController::augment('iteach.requests.fAllSwap');
		}

	}

	function swap(){

		$request = Session::get('request');
		Session::forget('request');

		if(Auth::User()->type == 'admin')
			return AdminController::augmentWithRequest('iteach.requests.aSwapOne', $request);
		else
			return FacultyController::augmentWithRequest('iteach.requests.fSwapOne', $request);

	}

	function confirmSwapRequest(){

		$request = Session::get('request');
		Session::forget('request');

		Request::where('key', $request['key'])->update(['message' => ''.$request['message'].' <br><i><small>You approved this request</small></i>', 'response' => 'yes', 'link' => '#', 'processed' => true]);
		//processing here

		$recipient = instructor::where('employeeId', $request['recipient'])->get();
/*		
		Request::insert([
			'recipient' => ''
		]);
*/		//if approved by admin
		$temp = Section::join('swaps', 'swaps.sid', '=', 'sections.sid')
			->join('requests', 'requests.key', '=', 'swaps.rkey')
			->where('swaps.rkey', $request['key'])
			->get();

		Section::where('sid', $temp[0]->sid)
			->update(['sections.employeeId' => $request['heading'], 'updated_at' => date('Y-m-d H:i:s')]);

		Request::insert([
				'response' => 'happy',
				'recipient' => $request['heading'],
				'heading' => '',
				'message' => $recipient[0]->fname.' swapped subjects with you',
				'contentId' => '02',
				'link' => '#',
				'key' => bcrypt(date('Y-m-d H:i:s')),
				'processed' => true,
				'created_at' => date('Y-m-d H:i:s'),
		]);

		return redirect(Session::get('page', 'home'));

	}

	function denySwapRequest(){

		$request = Session::get('request');
		Session::forget('request');

		Request::where('key', $request['key'])->update(['message' => ''.$request['message'].' <br><i><small>You denied this request</small></i>', 'response' => 'no', 'link' => '#', 'processed' => true]);
		
		$recipient = instructor::where('employeeId', $request['recipient'])->get();
		//processing here, example below
		Request::insert([
				'response' => 'sad',
				'recipient' => $request['heading'],
				'heading' => '',
				'message' => $recipient[0]->fname.' does not want to swap subjects with you',
				'contentId' => '02',
				'link' => '#',
				'key' => bcrypt(date('Y-m-d H:i:s')),
				'processed' => true,
				'created_at' => date('Y-m-d H:i:s'),
		]);


		return redirect(Session::get('page', 'home'));

	}

	function viewAllRegistries(){

		return AdminController::augment('iteach.requests.aAllRegistry');
	
	}

	public static function createRegistryRequest($id){

		$key = bcrypt(date('Y-m-d H:i:s'));
		
		Request::insert([
			['response' => 'none',
			'recipient' => '', 
			'heading' => $id,	//admin if no emp number indicated
			'message' => 'I want to register my account!',
			'contentId' => '00',	//not yet fully implemented but code 00 == registry request
			'link'=> 'viewRequest?key='.$key,	//provide link to routes you want to go
			'key' => $key,
			'processed' => false,
			'created_at'=>date('Y-m-d H:i:s'),],
		]);

	}

	function confirmRegistryRequest(){

		$request = Session::get('request');
		Session::forget('request');

		Request::where('key', $request['key'])->update(['message' => ''.$request['message'].' <br><i><small>You approved this request</small></i>', 'response' => 'yes', 'link' => '#', 'processed' => true]);
		instructor::where('employeeId', $request['heading'])->update(['registered' => true]);

		return redirect(Session::get('page', 'home'));

	}

	function denyRegistryRequest(){

		$request = Session::get('request');
		Session::forget('request');

		Request::where('key', $request['key'])->update(['message' => ''.$request['message'].' <br><i><small>You denied this request</small></i>', 'response' => 'no', 'link' => '#', 'processed' => true]);
		User::where('employeeId', $request['heading'])->delete();

		$recipient = instructor::where('employeeId', $request['recipient'])->get();
		//processing here, example below

		return redirect(Session::get('page', 'home'));

	}

	function createSwapRequest(){

		$course = Input::get('class');
		$requestor = Session::get('userInst')['employeeId'];
		$owner = Section::where('sid', $course)->get()[0]->employeeId;
		$key = bcrypt(date('Y-m-d H:i:s'));
		$courseName = Section::where('sid', $course)->get()[0]->courseNum.' '.Section::where('sid', $course)->get()[0]->sectionNum;

		Request::insert([
			['response' => 'none',
			'recipient' => $owner, 
			'heading' => $requestor,	//admin if no emp number indicated
			'message' => 'I want to swap '.$courseName.' with you!',
			'contentId' => '01',	//not yet fully implemented but code 01 == swap request
			'link'=> 'viewRequest?key='.$key,	//provide link to routes you want to go
			'key' => $key,
			'processed' => false,
			'created_at'=>date('Y-m-d H:i:s'),],
		]);

		Swap::insert([

			['rkey' => $key,
			'sid' => $course,
			'requestor' => $requestor,
			'owner' => $owner,
			'created_at'=>date('Y-m-d H:i:s'),],

		]);

		return redirect(Session::get('page', 'home'));

	}

	function cancelSwapRequest(){

		$key = Input::get('request');

		Request::where('key', $key)
			->update(['response' => 'ban',
				'link' => '#',
				'message' => ''.Request::where('key', $key)->get()[0]->message.' <br><i><small>'.Session::get('userInst')['fname'].' cancelled this request',
				'processed' => true]);

		return redirect(Session::get('page', 'home'));

	}

}
