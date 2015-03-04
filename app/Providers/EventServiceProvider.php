<?php namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\BaseModel;
use Menu;
use MenuItem;
class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		'event.name' => [
			'EventListener',
		],
	];

	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
		parent::boot($events);

		BaseModel::saved(function($modelInstance){
			$traits = $modelInstance->getTraits();
			if(isset($traits['App\\Navigatable'])){
				$basename = class_basename($modelInstance);
				$menu = Menu::all()->where(['name', '=' ,$basename])->first();
				if(!$menu){
					$menu = Menu::create(['name'=>$basename])->save();
				}
				$menuItem = MenuItem::all()->where(['navigatable_id','=',$modelInstance->id])->and([
					'navigatable_type','=',$basename
				])->first();
				if(!$menuItem || $modelInstance->isDirty(['title','slug'])){
					MenuItem::updateOrCreate([
						'navigatable_type'=>get_class($modelInstance),
						'navigatable_id'=>$modelInstance->id,
						'menu_id'=>$menu->id
					])->save();
				}
			}
		});
	}

}
