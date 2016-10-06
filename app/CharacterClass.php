<?php

namespace App;
//contracts
use App\Contracts\FillableContract;
use App\Contracts\RelatableContract;
use App\Traits\Relatable;
use App\Traits\Ruled;
use MartinBean\MenuBuilder\Contracts\Navigatable as NavigatableContract;
//traits
use App\Traits\Describable;
use App\Traits\Fillable;
use App\Traits\Navigatable; 
use App\Traits\Playable;
use App\Traits\Presentable;

use McCool\LaravelAutoPresenter\HasPresenter;

class CharacterClass extends BaseModel implements HasPresenter, FillableContract, NavigatableContract, RelatableContract {
	use Describable;
	use Fillable;
	use Navigatable; 
	use Presentable;
	use Playable;
	use Relatable;
	use Ruled;
	public $relationMethods = ['costs','playerCharacters'];
	public function costs(){
		return $this->hasMany('App\Cost');
	}
}
