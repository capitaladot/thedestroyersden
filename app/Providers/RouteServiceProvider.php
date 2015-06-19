<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider {
	
	/**
	 * This namespace is applied to the controller routes in your routes file.
	 *
	 * In addition, it is set as the URL generator's root namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'App\Http\Controllers';
	
	/**
	 * Define your route model bindings, pattern filters, etc.
	 *
	 * @param \Illuminate\Routing\Router $router        	
	 * @return void
	 */
	public function boot(Router $router) {
		parent::boot ( $router );
		/*
		 * $router->model ( 'arc', 'App\Arc' );
		 * $router->model ( 'character-class', 'App\CharacterClass' );
		 * $router->model ( 'cost', 'App\Cost' );
		 * $router->model ( 'craft', 'App\Craft' );
		 * $router->model ( 'crafting-component', 'App\CraftingComponent' );
		 * $router->model ( 'crafting-requirement', 'App\CraftingRequirement' );
		 * $router->model ( 'economy', 'App\Economy' );
		 * $router->model ( 'event', 'App\Event' );
		 * $router->model ( 'expenditure', 'App\Expenditure' );
		 * $router->model ( 'final-product', 'App\FinalProduct' );
		 * $router->model ( 'homeland', 'App\Homeland' );
		 * $router->model ( 'menu', 'App\Menu' );
		 * $router->model ( 'player-character', 'App\PlayerCharacter' );
		 * $router->model ( 'race', 'App\Race' );
		 * $router->model ( 'raw-resource', 'App\RawResource' );
		 * $router->model ( 'sale', 'App\Sale' );
		 * $router->model ( 'skill', 'App\Skill' );
		 * $router->model ( 'tool', 'App\Tool' );
		 * $router->model ( 'user', 'App\User' );
		 */
	}
	
	/**
	 * Define the routes for the application.
	 *
	 * @param \Illuminate\Routing\Router $router        	
	 * @return void
	 */
	public function map(Router $router) {
		$router->group ( [ 
				'namespace' => $this->namespace 
		], function ($router) {
			require app_path ( 'Http/routes.php' );
		} );
	}
}
