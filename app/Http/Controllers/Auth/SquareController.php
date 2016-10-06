<?php

namespace App\Http\Controllers\Auth;
use SquareConnect;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Log;

class SquareController extends \App\Http\Controllers\Controller{
	/**
	 * Redirect the user to the Square authentication page.
	 *
	 * @return Response
	 */
	public function redirectToProvider()
	{
		return Socialite::driver('square')->redirect();
	}

	/**
	 * Obtain the user information from Square.
	 *
	 * @return Response
	 */
	public function handleProviderCallback()
	{
		$user = Socialite::driver('square')->user();
		$user->token;
	}
}
