<?php


namespace App\Providers;

use View;
use Illuminate\Support\ServiceProvider;
use App\MainMenu;
use App\Presenters\FormattedUnorderedListPresenter;
use App\BaseModel;
use Illuminate\Support\Facades\DB;

class ComposerServiceProvider extends ServiceProvider {
	//only load when needed, not in maintaince mode!
	protected $defer = true;
	/**
	 * Register bindings in the container.
	 *
	 * @return void
	 */
	public function boot() {
		$linkMenu = MainMenu::where ( 'name', '=', 'Link' )->first ();
		if(!empty($linkMenu)){
			$linkPresenter = new FormattedUnorderedListPresenter ( $linkMenu, "nav navbar-nav" );
			View::share ( 'linkPresenter', $linkPresenter );
		}
		$menus = MainMenu::where ( 'name', '<>', 'Link' )
			->where ( 'name', '<>', 'User' )
			->where ( 'name', '<>', 'Event' )
			->where ( 'name', '<>', 'Crafting' )->get ();
		if(!empty($menus))
			View::share ( 'menus', $menus ); 
		$craftingMenu = MainMenu::where ( 'name', '=', 'Crafting' )->first ();
		View::share ( 'craftingMenu',$craftingMenu);
		$userMenu = MainMenu::where ( 'name', '=', 'User' )->first ();
		View::share ( 'userMenu', $userMenu );
		$eventMenu = MainMenu::where ( 'name', '=', 'Event' )->first ();
		View::share ( 'eventMenu', $eventMenu );
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