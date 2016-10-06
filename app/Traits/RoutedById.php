<?php

namespace App\Traits;
use App\MainMenu;
use App\MainMenuItem;
use Log;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;

trait RoutedById{
public static function bootRoutedById(){
	static::creating ( function ($modelInstance){
		Log::debug ( 'Creating ' . get_class($modelInstance), [
			$modelInstance
		] );
		return true;
	} );
	static::created ( function ( NavigatableContract $modelInstance) {
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
	public function getUrl(){
		try {
			return action("\\".str_replace("\\","\\Http\\Controllers\\",get_called_class())."Controller@show",['id'=>$this->id]);
		}
		catch ( FatalErrorException $e ) {
			Log::error ( $e );
			return false;
		}
	}
	public function getTitle(){
		return studly_case(str_singular(str_replace("_"," ",class_basename(get_called_class())))). " #".$this->id;
	}
	public static function isNavigable(NavigatableContract $modelInstance) {
		try{
			$modelInstance->load('menuItem');
			return count($modelInstance->menuItem);
		}
		catch(Exception $e){
			return false;
		}

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
				$newItem = new MainMenuItem( ['menu_id' => $menu->id]);
				$newItem->navigatable()->associate($modelInstance);
				$newItem->save();
			}
			catch(\QueryException $qe){
				Log::debug ( 'MenuItem already extant? ', ['model'=>$modelInstance,'menuItems'=>$menuItems] );
				return false;
			}
		}
		return $modelInstance;
	}
	/* relations */
	public function menuItem() {
		return $this->morphMany ( 'App\MainMenuItem', 'navigatable' );
	}
	public function menu() {
		return $this->menuItem->menu;
	}
}
