<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Handlers\Events\UserEventHandler;
use App\Events\UserLoggedIn;
use App\Events\UserLoggedOut;

class EventServiceProvider extends ServiceProvider {
	
	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [ 
	];

	/**
	 * The subscriber classes to register.
	 *
	 * @var array
	 */
	protected $subscribe = [
		'App\Listeners\UserEventListener',
		'App\Listeners\EmailEventListener',
	];
	/**
	 * Register any other events for your application.
	 *
	 * @param \Illuminate\Contracts\Events\Dispatcher $events        	
	 * @return void
	 */
	public function boot(DispatcherContract $events) {
		parent::boot ( $events );
	}
}
