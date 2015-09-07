<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Captcha;
use Event;
use App\Events\UserLoggedIn;
use App\Events\UserLoggedOut;
use Input;
use Validator;
use App\Http\Controllers\MyCaptchaController;
use Session;

class Captchad {
	
	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;
	protected $captcha;
	/**
	 * Create a new filter instance.
	 *
	 * @param Guard $auth        	
	 * @return void
	 */
	public function __construct(Guard $auth, Captcha $captcha) {
		$this->auth = $auth;
		$this->captcha = $captcha;
	}
	
	/**
	 * Handle an incoming request.
	 *
	 * @param \Illuminate\Http\Request $request        	
	 * @param \Closure $next        	
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		if ($this->auth->guest ()) {
			$rules = ['captcha' => 'required|captcha'];
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails())
            {
				if ($request->ajax ()) {
					return response ( 'Unauthorized.', 401 );
				} else {
					Session::put('captchadData',$request->all());
					$rules = ['captcha' => 'required|captcha'];
					$validator = Validator::make($request->all(), $rules);
					if ($validator->fails())
					{
						$error = !empty($request->input('captcha')) 
							?	'<p style="color: #ff0000;">Incorrect!</p>'
							:	'';
						$request->merge(['error'=>$error]);
						return redirect()->back()->withInput();
					}
				}
			}
		}
		$old = Session::get('captchadData');
		if(!empty(Session::pull('captchadData'))){
			$request->merge($old);
		}
		return $next ( $request );
	}
}
