<?php

namespace App;
//contracts
use MartinBean\MenuBuilder\Contracts\NavigatableContract;
//traits
use App\Traits\Describable;
use App\Traits\Fillable;
use App\Traits\Navigatable; 
use App\Traits\Playable;
use App\Traits\Presentable;

use App\BaseModel; 
use McCool\LaravelAutoPresenter\HasPresenter;

class CharacterClass extends BaseModel implements HasPresenter, NavigatableContract {
	use Describable;
	use Fillable;
	use Navigatable; 
	use Presentable;
	use Playable;
	public $relationMethods = ['costs','playerCharacters'];
	public function costs(){
		return $this->hasMany('App\Cost');
	}
}