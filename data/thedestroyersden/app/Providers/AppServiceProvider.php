<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk as LaravelFacebookSdk;
use View;

class AppServiceProvider extends ServiceProvider {
	
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot(LaravelFacebookSdk $fb) {
		$login_link = $fb->getRedirectLoginHelper ()->getLoginUrl ( 'http://destroyersden.com/facebook/callback', [ 
				'email',
				'user_events' 
		] );
		
		View::share ( 'facebook_login_link', $login_link );
	}
	
	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register() {
		$this->app->bind ( 'Illuminate\Contracts\Auth\Registrar', 'App\Services\Registrar' );
	}
}
