<?php

namespace App\Handlers\Events;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Log;

class UserEventHandler {
	
	/**
	 * Handle user login events.
	 */
	public function onUserLogin($event) {
		Log::debug ( 'User logged in.' );
	}
	
	/**
	 * Handle user logout events.
	 */
	public function onUserLogout($event) {
		Session::flush ();
		Session::regenerate ();
		Cookie::forget ( 'XSRF-Token' );
		Log::debug ( 'User logged out.' );
	}
	
	/**
	 * Register the listeners for the subscriber.
	 *
	 * @param Illuminate\Events\Dispatcher $events        	
	 * @return void
	 */
	public function subscribe($events) {
		$events->listen ( 'auth.login', 'App\Handlers\Events\UserEventHandler@onUserLogin' );
		$events->listen ( 'auth.logout', 'App\Handlers\Events\UserEventHandler@onUserLogout' );
	}
}