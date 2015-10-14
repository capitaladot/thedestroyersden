<?php

namespace App\Traits;

use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use MartinBean\MenuBuilder\MenuItem;
use MartinBean\MenuBuilder\Menu;
use Barryvdh\Debugbar\Facade as Debugbar;
use Symfony\Component\Debug\Exception\FatalErrorException;

trait Navigatable {
	/* relations */
	public function getTitle() {
		return $this->title;
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
		return $this->morphMany ( 'MartinBean\MenuBuilder\MenuItem', 'navigatable' );
	}
	public function menu() {
		return $this->menuItem->menu;
	}
}