<?php

namespace App\Services;

use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;
use Log;
use Hash;
class Registrar implements RegistrarContract {
	
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
