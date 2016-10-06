<?php

namespace App;

use MartinBean\MenuBuilder\Menu;
use MartinBean\MenuBuilder\MenuItem;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;
use App\Traits\Relatable;


class MainMenu extends Menu {
	use Relatable;
	protected $table = 'menus';
	protected $fillable = ['name','appendedItems'];
	protected $appends = ['appendedItems'];
	public $appendedItems;

	/**
	 * MainMenu constructor.
	 * @param array $attributes
	 */
	public function __construct(array $attributes =[])
	{
		parent::__construct($attributes);
		$this->appendedItems = collect();
	}
	public function properName() {
		return ucwords ( str_replace ( '_', ' ', snake_case ( $this->name ) ) );
	}
	public function pluralName(){
		return str_plural ( $this->properName());
	}
	public function permissionPrefix(){
		return strtolower(substr($this->model,4));
	}
	/**
	 * @param User $user
	 * @param MainMenu $menu
	 * @return mixed
	 */
	public function canCreate(User $user,MainMenu $menu = null){
		if(is_null($menu))
			$menu = $this;
		$test = $user->can('create.'. str_slug($menu->name));
		return $test;
	}

	/**
	 * @param User $user
	 * @param MainMenu $menu
	 * @return mixed
	 */
	public function canList(User $user,MainMenu $menu = null){
		if(is_null($menu))
			$menu = $this;
		$test = $user->can('list.'.str_slug($menu->name));
		return $test;
	}
	public function getUrl() {
		try {
			$routeString = str_singular ( studly_case ( $this->getTable () ) ) . 'Controller@show';
			if(!empty($this->slug)){
				$url = action ( $routeString, [
					$this->slug
				] );
			}
			if(empty($url))
				$url = action($routeString,['id'=>$this->id]);
		} catch ( FatalErrorException $e ) {
			Log::error ( $e );
		}
		return $url;
	}
	/* relations */
	public function getTitle() {
		return $this->name;
	}
	public function items() {
		return $this->hasMany ( 'App\MainMenuItem', 'menu_id' );
	}
	public function menuItem() {
		return $this->morphMany ( 'App\MainMenuItem', 'navigatable' );
	}
	public function menu() {
		return $this->menuItem->menu;
	}
}
