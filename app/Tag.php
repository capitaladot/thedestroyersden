<?php


namespace App;

use App\BaseModel; use McCool\LaravelAutoPresenter\HasPresenter;
use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\Traits\Navigatable; use App\Traits\Presentable;

class Tag extends BaseModel implements HasPresenter, NavigatableContract {
	public function rawResources() {
		return $this->morphedByMany ( 'App\RawResource', 'taggable' );
	}
	public function craftingComponents() {
		return $this->morphedByMany ( 'App\CraftingComponent', 'taggable' );
	}
	public function finalProducts() {
		return $this->morphedByMany ( 'App\FinalProduct', 'taggable' );
	}
}