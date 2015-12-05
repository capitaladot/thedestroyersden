<?php

namespace App\Traits;

use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\MainMenuItem;
use App\MainMenu;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Debug\Exception\FatalErrorException;

trait Navigatable {
	public static function bootNavigatable(){
		static::creating ( function ($modelInstance){
			Log::debug ( 'Creating ' . get_class($modelInstance), [ 
					$modelInstance
			] );
			$wasNotNavigable = ! self::isNavigable ( $modelInstance );
			if ($wasNotNavigable) {
				if(self::fixNavigability ( $modelInstance )){
					Log::info ( 'Fixed navigatibilty during creation of  ' . get_class($modelInstance), [ 
						$modelInstance 
					] );
					return true;
				}
			}
		} );
		static::created ( function ($modelInstance) {
			Log::info ( 'Created ' . get_class($modelInstance), [ 
				$modelInstance 
			] );
			$menuItem = $modelInstance->menuItem;
			if(!$menuItem)
				if(self::provideNavigatable($modelInstance)){
					Log::debug('Created with Menu item',[$modelInstance->menuItem]);
					return true;
				}
		} );
		static::updating ( function ($modelInstance) {
			Log::info ( 'Updating ' . get_class($modelInstance), [ 
					$modelInstance 
			] );
		} );
		static::updated ( function ($modelInstance) {
			Log::info ( 'Updated ' . get_class($modelInstance), [ 
					$modelInstance 
			] );
		} );
		static::saving ( function ($modelInstance) {
			Log::info ( 'Saving ' . get_class($modelInstance), [ 
					$modelInstance 
			] );
		} );
		static::saved ( function ($modelInstance) {
			Log::debug ( 'Saved ' . get_class($modelInstance), [ 
					$modelInstance 
			] );
		} );
		static::deleted(function($modelInstance){
			Log::debug ( 'Deleted ' . get_class($modelInstance), [ 
					$modelInstance 
			] );
			$menuItems = $modelInstance->menuItem()->get();
			if(count($menuItems)){
				foreach($menuItems as $menuItem){
					$deleted = $menuItem->delete();
					Log::debug ( 'Deleted menu item: ',[ 
						$menuItem
					] );
				}
				return true;
			}
		});
	}
	/* relations */
	public function getTitle() {
		return $this->title;
	}
	public function getUrl() {
		try {
			$routeString = str_singular ( studly_case( $this->getTable () ) ) . 'Controller@show';
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