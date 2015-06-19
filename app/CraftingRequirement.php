<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract; use App\Traits\Navigatable; use App\Traits\Presentable;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use App\BaseModel; use McCool\LaravelAutoPresenter\HasPresenter;

class CraftingRequirement extends BaseModel implements HasPresenter, NavigatableContract {
	use Navigatable; use Presentable;
	use Titleable;
	protected $table = 'crafting_requirements';
	public $timestamps = true;
	
	use SoftDeletingTrait;
	protected $dates = [
			'deleted_at'
	];
	public function craft() {
		return $this->belongsTo ( 'App\Craft' );
	}
	public function craftingComponents() {
		return $this->morphedByMany ( 'App\CraftingComponent', 'requireable' );
	}
	public function rawResources() {
		return $this->morphedByMany ( 'App\RawResource', 'requireable' );
	}
	public function tools() {
		return $this->morphedByMany ( 'App\Tool', 'requireable' );
	}
}