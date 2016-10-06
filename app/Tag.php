<?php


namespace App;

use App\BaseModel;
use App\Contracts\FillableContract;
use App\Contracts\RelatableContract;
use App\Traits\Fillable;
use App\Traits\Relatable;
use McCool\LaravelAutoPresenter\HasPresenter;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;
use App\Traits\Navigatable;
use App\Traits\Presentable;

class Tag extends BaseModel implements FillableContract, HasPresenter, NavigatableContract, RelatableContract {
	use Fillable;
	use Navigatable;
	use Presentable;
	use Relatable;
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
