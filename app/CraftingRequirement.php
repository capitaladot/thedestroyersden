<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract; 
use App\Traits\Navigatable; 
use App\Traits\Presentable;
use App\Traits\Requirable;

use App\BaseModel; 
use McCool\LaravelAutoPresenter\HasPresenter;

class CraftingRequirement extends BaseModel implements HasPresenter, NavigatableContract {
	use Navigatable; 
	use Presentable;
	use Requirable;
	protected $table = 'crafting_requirements';
	public $timestamps = true;
	protected $dates = [
		'deleted_at'
	];
	public function alternates(){
		return $this->morphedByMany ( 'App\Alternate' );
	}
	public function craft() {
		return $this->belongsTo ( 'App\Craft' );
	}
	public function craftingComponents() {
		return $this->belongsToMany ( 'App\CraftingComponent','App\Craft' );
	}
	public function rawResources() {
		return $this->belongsToMany ( 'App\RawResource','App\Craft');
	}
	public function requirables(){
		return $this->morphTo();
	}
	public function tools() {
		return $this->belongsToMany ( 'App\Tool','App\Craft');
	}
}