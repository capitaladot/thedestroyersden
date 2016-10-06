<?php

namespace App\Traits;

use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;
use App\MainMenuItem;
use App\MainMenu;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Debug\Exception\FatalErrorException;
use App\BaseModel;

trait Navigatable {
	public static function bootNavigatable(){
		static::creating ( function (NavigatableContract $modelInstance){
			Log::debug ( 'Creating ' . get_class($modelInstance), [ 
					$modelInstance
			] );
			$wasNotNavigable = ! self::isNavigable ( $modelInstance );
			if ($wasNotNavigable) {
				if(self::fixNavigability ( $modelInstance )){
					Log::info ( 'Fixed navigability during creation of  ' . get_class($modelInstance), [ 
						$modelInstance 
					] );
					
				}
			}
			return true;
		} );
		static::created ( function (NavigatableContract $modelInstance) {
			Log::info ( 'Created ' . get_class($modelInstance), [$modelInstance]);
			if(!self::isNavigable($modelInstance)){
				Log::debug('Menu item test',[$modelInstance->menuItem]);
				self::provideNavigatable($modelInstance);
				Log::debug('Created with Menu item',[$modelInstance->menuItem]);
			}
			else
				Log::debug('Had Menu item',[]);
			Log::debug ( 'After created ' , [$modelInstance->menuItem]);
			return true;
		} );
		static::updating ( function (NavigatableContract $modelInstance) {
			Log::info ( 'Updating ' . get_class($modelInstance), [$modelInstance]);
		} );
		static::updated ( function (NavigatableContract $modelInstance) {
			Log::info ( 'Updated ' . get_class($modelInstance),[$modelInstance]);
		} );
		static::saving ( function (NavigatableContract $modelInstance) {
			Log::info ( 'Saving ' . get_class($modelInstance), [$modelInstance]);
		} );
		static::saved ( function (NavigatableContract $modelInstance) {
			Log::debug ( 'Saved ' . get_class($modelInstance),[$modelInstance]);
		} );
		static::deleted(function(NavigatableContract $modelInstance){
			Log::debug ( 'Deleted ' . get_class($modelInstance), [$modelInstance] );
			$menuItems = $modelInstance->menuItem()->get();
			if(count($menuItems)){
				foreach($menuItems as $menuItem){
					$deleted = $menuItem->delete();
					Log::debug ( 'Deleted menu item: ',[ 
						$menuItem->getTitle()=>$deleted
					] );
				}
				return true;
			}
		});
	}

	/**
	 * @param $modelInstance
	 * @return bool
	 */
	public static function isNavigable(NavigatableContract $modelInstance) {
		$modelInstance->load('menuItem');
		return ! (empty ( $modelInstance->getUrl() ) || empty ( $modelInstance->getTitle() ) || !count($modelInstance->menuItem));
	}
	/**
	 *
	 * @desc set slug and/or title, and if necessary, create MenuItems.
	 *
	 * @param BaseModel $modelInstance        	
	 */
	public static function fixNavigability(NavigatableContract $modelInstance) {
		Log::info ( 'Fixing navigability for', [ 
			$modelInstance 
		] );
		if (!empty($modelInstance->name) && empty ( $modelInstance->slug )) {
			$modelInstance->slug = str_slug ( $modelInstance->name );
			return $modelInstance;
		}
		if (!empty($modelInstance->name) && empty ( $modelInstance->title )) {
			$modelInstance->title = $modelInstance->name;
			return $modelInstance;
		}
		if (!empty($modelInstance->title) && empty ( $modelInstance->slug )) {
			$modelInstance->slug = str_slug ( $modelInstance->title );
			return $modelInstance;
		}
		if(!empty($modelInstance->getTitle()) && !empty($modelInstance->getUrl()))
			return $modelInstance;
		return false;
	}
	/**
	 *
	 * @param BaseModel $modelInstance        	
	 */
	public static function provideNavigatable(NavigatableContract $modelInstance) {
		Log::debug('Providing navigatable for :',[$modelInstance]);
		$basename = class_basename ( $modelInstance );
		$menu = MainMenu::where ( 'name', $basename )->first ();
		if (is_null($menu)) {
			try{
				Log::debug('Creating MainMenu for: '.$basename);
				$menu = MainMenu::create ( [ 
					'name' => $basename 
				] );
			}
			catch(\ErrorException $ee){
				Log::critical('Failed creating menu with: '.$ee->getMessage());
				return false;
			}		
		}
		$menuItems = MainMenuItem::with('menu')->get ()->filter(function($eachMenuItem)use($basename,$menu,$modelInstance){
			return 
				$eachMenuItem->menu->id == $menu->id
					&&
				$eachMenuItem->navigatable_type == $basename
					&&
				$eachMenuItem->navigatable_id = $modelInstance->id;
		});
		if (! count($menuItems) ){
			Log::debug ( 'Creating MenuItem for ', ['model'=>$modelInstance,'basename'=>$basename] );
			try{
				$newItem = MainMenuItem::create( ['menu_id' => $menu->id]);
				$newItem->navigatable()->associate($modelInstance);
				$newItem->save();
			}
			catch(\QueryException $qe){
				Log::debug ( 'MenuItem already extant? ', ['model'=>$modelInstance,'menuItems'=>$menuItems] );
				return false;
			}
		}
		$modelInstance->load('menuItem');
		return $modelInstance;
	}
	public function getTitle() {
		return $this->title;
	}
	public function getSlug() {
		return str_slug($this->title);
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
			return false;
		}
		return $url;
	}
	/* relations */
	public function menuItem() {
		return $this->morphMany ( 'App\MainMenuItem', 'navigatable' );
	}
	public function menu() {
		return $this->menuItem->menu;
	}
}
