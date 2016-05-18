<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk as LaravelFacebookSdk;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth,LaravelFacebookSdk $fb)
	{
		$this->auth = $auth;

		$this->middleware('guest', ['except' => 'getLogout']);
		$login_link = $fb->getRedirectLoginHelper ()->getLoginUrl ( 'http://destroyersden.com/facebook/login-callback', [ 
				'email',
				'user_events'
		] );
		View::share ( 'facebook_login_link', $login_link );
	}
	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param array $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data) {
		Log::debug('Validating user creation data',$data);
		return Validator::make ( $data, [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6'
		] );
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param array $data
	 * @return User
	 */
	public function create(array $data) {
		Log::debug('User creation data',$data);
		$user = new User;
		$data['slug'] = str_slug ( $data ['name'],'-' );
		$data['password'] = Hash::make ( $data ['password'] );
		$data['title'] = $data ['name'];
		Log::debug('Processed user creation data',$data);
		if($user->validate($data) && $user->save())
			return $user;
		Log::error('Failed to create user; validation reported:',$user->validator->errors);
	}
}
