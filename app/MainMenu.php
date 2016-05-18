<?php

namespace App;

use MartinBean\MenuBuilder\Menu;
use MartinBean\MenuBuilder\MenuItem;
use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\Traits\Relatable;


class MainMenu extends Menu {
	use Relatable;
	protected $table = 'menus';
	protected $fillable = ['appendedItems'];
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
		return str_plural ( ucwords ( str_replace ( '_', ' ', snake_case ( $this->name ) ) ) );
	}
	public function items() {
		return $this->hasMany ( 'App\MainMenuItem', 'menu_id' );
	}
	/* relations */
	public function getTitle() {
		return $this->name;
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
	public function menuItem() {
		return $this->morphMany ( 'App\MainMenuItem', 'navigatable' );
	}
	public function menu() {
		return $this->menuItem->menu;
	}
}
