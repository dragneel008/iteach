<?php namespace App\Http\Middleware;

use Closure;
use App\Request;
use Input;
use Session;

class ValidateRequest {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		
		$tuple = Request::where('key', Input::get('key', 'null'))->get();
		if(empty($tuple[0]))
			return redirect('home');
		else if($tuple[0]->processed){
			Request::where('key', Input::get('key'))->update(['link' => '#']);
			return redirect('home');
		}

		Session::forget('request');
		Session::put('request', $tuple[0]);

		return $next($request);
	}

}
