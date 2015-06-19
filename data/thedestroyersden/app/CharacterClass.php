<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\Navigatable;
use App\BaseModel;
use App\Fillable;

class CharacterClass extends BaseModel implements NavigatableContract {
	use Navigatable;
	use Fillable;
	public $relationMethods = ['costs'];
	public function costs(){
		return $this->hasMany('App\Cost');
	}
}