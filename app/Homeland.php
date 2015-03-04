<?php
namespace App;
use MartinBean\MenuBuilder\Contracts\NavigatableContract;
use App\Navigatable;
use App\Fillable;
use App\BaseModel;
class Homeland extends BaseModel implements NavigatableContract{
	use Navigatable;
	use Fillable;
	public $relationMethods = ['costs','playerCharacters'];
	public function playerCharacters(){
		return $this->hasMany('App\PlayerCharacter');
	}
	public function costs(){
		return $this->hasMany('App\Costs');
	}
}