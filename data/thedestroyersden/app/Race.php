<?php
namespace App;

use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\Navigatable;
use App\BaseModel;
use App\Fillable;

class Race extends BaseModel implements NavigatableContract{
	public $relationMethods = ['costs','playerCharacters'];
	public function playerCharacters(){
		return $this->hasMany('App\PlayerCharacter');
	}
	public function costs(){
		return $this->hasMany('App\Costs');
	}
}