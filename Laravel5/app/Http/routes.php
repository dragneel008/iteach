<?php

use App\Request;
use App\Instructor;
use App\section;
use App\Swap;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'ITEACH\AuthController@index');
Route::get('index', 'ITEACH\AuthController@index');

Route::get('login', ['middleware' => 'guest', 'uses' => 'ITEACH\AuthController@login']);
Route::post('attempt_login', ['middleware' => 'guest', 'uses' => 'ITEACH\AuthController@attempt']);

Route::get('guest', 'ITEACH\AuthController@use_guest');

Route::get('register', ['middleware' => 'guest', 'uses' => 'ITEACH\AuthController@signup']);
Route::post('attempt_register', ['middleware' => 'guest', 'uses' => 'ITEACH\AuthController@attempt_register']);

Route::get('home', ['middleware' => 'auth', 'uses' => 'ITEACH\HomeController@home']);

// Administrator Routes
Route::get('addCourse', ['middleware' => 'admin', 'uses' => 'ITEACH\AdminController@addCourse']);
Route::get('addSection', ['middleware' => 'admin', 'uses' => 'ITEACH\AdminController@addSection']);
Route::get('swapSection', ['middleware' => 'admin', 'uses' => 'ITEACH\AdminController@swapSection']);

Route::post('processAddSection', ['middleware' => 'admin', 'uses' => 'ITEACH\AdminController@processAddSection']);
Route::post('processAddCourse', ['middleware' => 'admin', 'uses' => 'ITEACH\AdminController@processAddCourse']);
Route::post('processDissolveSection', ['middleware' => 'admin', 'uses' => 'ITEACH\AdminController@processDissolveSection']);

Route::get('dissolveSection', ['middleware' => 'admin', 'uses' => 'ITEACH\AdminController@dissolveSection']);
Route::get('viewSystemLog', ['middleware' => 'admin', 'uses' => 'ITEACH\AdminController@viewSystemLog']);
Route::get('editMinorDetailsFaculty', ['middleware' => 'admin', 'uses' => 'ITEACH\AdminController@editMinorDetailsFaculty']);
Route::get('editMinorDetailsRoom', ['middleware' => 'admin', 'uses' => 'ITEACH\AdminController@editMinorDetailsRoom']);
Route::get('uploadCSVFile', ['middleware' => 'admin', 'uses' => 'ITEACH\AdminParserController@index']);
Route::post('processCSVFile', 'ITEACH\AdminParserController@processCSV');
Route::post('assignInstructor', ['middleware' => 'admin', 'uses' => 'ITEACH\AdminController@assignInstructor']);

Route::get('viewAllRequests', ['middleware' => 'admin', 'uses' => 'ITEACH\AdminController@viewAllRequests']);
Route::post('approveRequest', 'ITEACH\AdminController@approveRequest');
Route::post('getRoom', 'ITEACH\AdminController@getRoom');
Route::post('editRoomCapacity', 'ITEACH\AdminController@editRoomCapacity');


//Integrated View Routes
Route::get('viewAll', 'ITEACH\ViewController@viewAll');
Route::get('viewCourse', 'ITEACH\ViewController@viewCourse');
Route::get('viewInstructor', 'ITEACH\ViewController@viewInstructor');
Route::get('viewRoom', 'ITEACH\ViewController@viewRoom');
Route::get('viewSwapRequests', 'ITEACH\RequestController@viewAllSwaps');
Route::get('viewRegistryRequests', 'ITEACH\RequestController@viewAllRegistries');


//Simply log out then return to index.
Route::get('logout', function(){
	Session::forget('guest');
	Session::forget('userInst');
	Session::forget('requests');
	Auth::logout();
	return redirect()->intended('index');
});

//Requests Routes
Route::get('viewRequest', ['middleware' => 'request', 'uses' => 'ITEACH\RequestController@processRedirect']);
Route::get('confirmSwapRequest', ['middleware' => 'request', 'uses' => 'ITEACH\RequestController@confirmSwapRequest']);
Route::get('denySwapRequest', ['middleware' => 'request', 'uses' => 'ITEACH\RequestController@denySwapRequest']);
Route::get('createSwapRequest', 'ITEACH\RequestController@createSwapRequest');
Route::get('confirmRegistryRequest', ['middleware' => 'request', 'uses' => 'ITEACH\RequestController@confirmRegistryRequest']);
Route::get('denyRegistryRequest', ['middleware' => 'request', 'uses' => 'ITEACH\RequestController@denyRegistryRequest']);

//temp route to test for request notifs
Route::get('newmsg', function(){

	Request::insert([
			['response' => 'none',
			'recipient' => '105', 
			'heading' => '140',	//admin if no emp number indicated
			'message' => 'I want to swap a subject with you!',
			'contentId' => '01',	//not yet fully implemented but code 01 == swap request
			'link'=> 'viewRequest?key='.bcrypt(date('Y-m-d G:i:s')),	//provide link to routes you want to go
			'key' => bcrypt(date('Y-m-d G:i:s')),
			'processed' => false,
			'time'=>date('Y-m-d G:i:s')],
	]);

});

Route::get('createSwaps', function(){

	$requestor = '140';
	$owner = '105';
	$key = bcrypt(date('Y-m-d G:i:s'));
	$course = 'CMSC 128 AB-3L';

	Request::insert([
			['response' => 'none',
			'recipient' => $owner, 
			'heading' => $requestor,	//admin if no emp number indicated
			'message' => 'I want to swap '.$course.' with you!',
			'contentId' => '01',	//not yet fully implemented but code 01 == swap request
			'link'=> 'viewRequest?key='.$key,	//provide link to routes you want to go
			'key' => $key,
			'processed' => false,
			'time'=>date('Y-m-d G:i:s')],
	]);

	Swap::insert([

		['rkey' => $key,
		'sectionNum' => $course,
		'requestor' => $requestor,
		'owner' => $owner,],

	]);

});

//temp route that registers employee 134
Route::get('register_034', function(){

	DB::table('instructors')
		->where('employeeId', '034')
		->update(['registered' => true]);

});	

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
