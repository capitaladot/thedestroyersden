<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk as LaravelFacebookSdk;
use Illuminate\Support\Facades\View;
use App\MainMenu;
use App\Presenters\FormattedUnorderedListPresenter;

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
		$linkMenu = MainMenu::where ( 'name', '=', 'Link' )->first ();
		$linkPresenter = new FormattedUnorderedListPresenter ( $linkMenu, "nav navbar-nav" );
		View::share ( 'linkPresenter', $linkPresenter );
		$menus = MainMenu::where ( 'name', '<>', 'Link' )->where ( 'name', '<>', 'User' )->get ();
		View::share ( 'menus', $menus );
		$userMenu = MainMenu::where ( 'name', '=', 'User' )->first ();
		View::share ( 'userMenu', $userMenu );
		if(!\Auth::user())
			\Debugbar::disable();
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
