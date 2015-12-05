<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use McCool\LaravelAutoPresenter\HasPresenter;
use App\Traits\Fillable;
use App\Traits\Playable;
use App\Traits\Navigatable; 
use App\Traits\Presentable;

use App\BaseModel;
use App\Cost;

class Race extends BaseModel implements HasPresenter, NavigatableContract {
	use Fillable;
	use Navigatable; 
	use Presentable;
	use Playable;
	public $relationMethods = [ 
			'costs',
			'playerCharacters' 
	];
	public function costs() {
		return $this->hasMany ( 'App\Cost' );
	}
}