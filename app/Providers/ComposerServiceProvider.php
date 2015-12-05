<?php


namespace App\Providers;
use Log;
use Illuminate\Support\ServiceProvider;
use View;

class ComposerServiceProvider extends ServiceProvider {
	//only load when needed, not in maintenance mode!
	//protected $defer = true;
	/**
	 * Register bindings in the container.
	 *
	 * @return void
	 */
	public function boot() {
		View::composer('*', 'App\Http\Composers\AppComposer');
	}
	
	/**
	 * Register
	 *
	 * @return void
	 */
	public function register() {
		//
	}
}