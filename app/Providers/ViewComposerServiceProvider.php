<?php


namespace App\Providers;
use Log;
use Illuminate\Support\ServiceProvider;
use View;
use App\Http\Composers\CartComposer;
use App\Http\Composers\MenuComposer;

class ViewComposerServiceProvider extends ServiceProvider {
	//only load when needed, not in maintenance mode!
	/**
	 * Register bindings in the container.
	 *
	 * @return void
	 */
	public function boot() {
		View::composer('*', CartComposer::class);
		View::composer('*', MenuComposer::class);
		View::composer('errors.*', 'App\Http\Composers\ErrorComposer');
		View::composer('vendor.error.*', 'App\Http\Composers\ErrorComposer');
		View::composer('vendor.forum.*', 'App\Http\Composers\ForumComposer');
	}
	
	/**
	 * Register
	 *
	 * @return void
	 */
	public function register() {
		//$this->app->singleton(MenuComposer::class);
	}
}
