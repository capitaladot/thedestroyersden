<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\BaseModel; use McCool\LaravelAutoPresenter\HasPresenter;
use App\Traits\Fillable;
use App\Traits\Navigatable; use App\Traits\Presentable;

class Race extends BaseModel implements HasPresenter, NavigatableContract {
	use Navigatable; use Presentable;
	public $relationMethods = [ 
			'costs',
			'playerCharacters' 
	];
	public function playerCharacters() {
		return $this->hasMany ( 'App\PlayerCharacter' );
	}
	public function costs() {
		return $this->hasMany ( 'App\Costs' );
	}
}