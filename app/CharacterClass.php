<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\Traits\Navigatable; use App\Traits\Presentable;
use App\BaseModel; use McCool\LaravelAutoPresenter\HasPresenter;
use App\Traits\Fillable;

class CharacterClass extends BaseModel implements HasPresenter, NavigatableContract {
	use Navigatable; use Presentable;
	use Fillable;
	public $relationMethods = ['costs'];
	public function costs(){
		return $this->hasMany('App\Cost');
	}
}