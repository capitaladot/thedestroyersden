<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Log;
use Auth;
use App\User;


class UserEventListener {
	
	/**
	 * Handle user login events.
	 */
	public function onUserLogin(User $user) {
		Log::debug ( 'User '.$user->name.' logged in.' );
	}
	
	/**
	 * Handle user logout events.
	 */
	public function onUserLogout(User $user) {
		Log::debug ( 'User '.$user->name.' logging out.' );
		Session::flush ();
		Session::regenerate ();
		Cookie::forget ( 'XSRF-Token' );
		Log::debug ( 'User logged out.' );
	}
	
	/**
	 * Register the listeners for the subscriber.
	 *
	 * @return void
	 */
	public function subscribe($events) {
		$events->listen ( 'auth.login', 'App\Listeners\UserEventListener@onUserLogin' );
		$events->listen ( 'auth.logout', 'App\Listeners\UserEventListener@onUserLogout' );
	}
}
