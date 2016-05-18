<?php

namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\BaseModel;

use App\Traits\Navigatable;

class Requisite extends BaseModel implements NavigatableContract  {
	use Navigatable;	
	protected $table = 'requisites';
	public function craftingRequirements(){
		return $this->morphToMany('App\CraftingRequirements');
	}
}